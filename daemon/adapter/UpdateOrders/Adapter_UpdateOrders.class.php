<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_UpdateOrders extends PlentySoapCall 
{
	
	private static $instance = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	public function __construct() {
		parent::__construct ( __CLASS__ );
		$this->initMagentoController ();
	}
	
	public static function getInstance() {
		if (! isset ( self::$instance ) || ! (self::$instance instanceof Adapter_UpdateOrders)) {
			self::$instance = new Adapter_UpdateOrders();
		}
		return self::$instance;
	}

	private function initMagentoController() {
		$magentoSoapClient = MagentoSoapClient::getInstance ();
		$magentoSoapClient->doAuthentification ();
		self::$magentoSession = $magentoSoapClient->getSession ();
		self::$magentoClient = $magentoSoapClient->getSoapClient ();
	}
	
	/*
	 * (non-PHPdoc) @see PlentySoapCall::execute()
	 */
	public function execute() {
		try{
			$this->getLogger()->info(":: Starte Update: Bestellungen ::");
			
			$orderList = $this->getNewOrders();

			while($magento_order_id = $orderList->fetchAssoc()){
				$magento_order_info = self::$magentoClient->call(self::$magentoSession, 'sales_order.info', $magento_order_id["order_id"]);
				$plenty_customer_info = $this->getPlentyCustomerByEmail($magento_order_info["customer_email"]);
				
				if(empty($plenty_customer_info->Customers->item)){
					$plenty_customer_id = $this->createPlentyCustomer($magento_order_info);
				}else {
					$plenty_customer_id = $plenty_customer_info->Customers->item[0]->CustomerID;
				}
				if(!empty($plenty_customer_id)){
					$this->buildOrder($plenty_customer_id, $magento_order_info, $magento_order_id["order_id"]);
					if(!empty($magento_order_info["payment"]["base_amount_paid"])){
						$this->addPayment($magento_order_info);
					}
				}
			}
		}catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}

		
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Update: Bestellungen  - beendet ::");
	}
	
	private function addPayment($magento_order_info){
	
		$plenty_order_infos = $this->getPlentyOrderInfos($magento_order_info["increment_id"]);
	
		if($plenty_order_infos->getNumRows() > 0){
			
			while($plenty_order = $plenty_order_infos->fetchAssoc()){
				$plenty_order_id = $plenty_order["plenty_order_id"];
				$plenty_customer_id = $plenty_order["plenty_customer_id"];
			}
			
			
			$payment_method = $magento_order_info["payment"]["method"];
			$payment_trans_id = $magento_order_info["payment"]["last_trans_id"];
			
			$oPlentySoapObject_AddIncomingPayments = new PlentySoapObject_AddIncomingPayments();
			$oPlentySoapObject_AddIncomingPayments->Amount = $magento_order_info["payment"]["base_amount_paid"];
			$oPlentySoapObject_AddIncomingPayments->ReasonForPayment = $payment_method.":".$payment_trans_id;
			$oPlentySoapObject_AddIncomingPayments->TransactionID = $magento_order_info["payment"]["payment_id"]."-".$plenty_order_id;
			$oPlentySoapObject_AddIncomingPayments->CustomerID = $plenty_customer_id;
			$oPlentySoapObject_AddIncomingPayments->Currency = "EUR";
			$oPlentySoapObject_AddIncomingPayments->MethodOfPaymentID = 0;
			$oPlentySoapObject_AddIncomingPayments->OrderID = $plenty_order_id;
			$oPlentySoapObject_AddIncomingPayments->TransactionTime = strtotime($magento_order_info["status_history"][0]["created_at"]);
			
			$oArrayOfPlentysoapobject_addincomingpayments = new ArrayOfPlentysoapobject_addincomingpayments();
			$oArrayOfPlentysoapobject_addincomingpayments->item = $oPlentySoapObject_AddIncomingPayments;
				
			$oPlentySoapRequest_AddIncomingPayments = new PlentySoapRequest_AddIncomingPayments();
			$oPlentySoapRequest_AddIncomingPayments->IncomingPayments = $oArrayOfPlentysoapobject_addincomingpayments;
				
			$result = $this->getPlentySoap()->AddIncomingPayments($oPlentySoapRequest_AddIncomingPayments);
		}
	
	}
	
	private function buildOrder($plenty_customer_id, $magento_order_info, $magento_order_id){
		$this->createPlentyDeliveryAdress($magento_order_info, $plenty_customer_id);
		$response = $this->createPlentyOrder($plenty_customer_id, $magento_order_info);

		if($response->Success){
			$i = 0;
			while($i < count($response->ResponseMessages->item[0]->SuccessMessages->item)){
				if($response->ResponseMessages->item[0]->SuccessMessages->item[$i]->Key == "OrderID"){
					$plenty_order_id = $response->ResponseMessages->item[0]->SuccessMessages->item[$i]->Value;
					$this->addOrderNote($plenty_order_id, "Liefertag: ".$magento_order_info["deliverydate"][0]["value"]);
					$this->addOrderMapping($plenty_order_id, $magento_order_id, $plenty_customer_id, $magento_order_info["customer_id"]);
					//$this->removeOrderFromDatabase($magento_order_id);
				}
				$i++;
			}
		}
	}
	
	private function createPlentyOrder($plenty_customer_id, $magento_order_info){
		$oPlentySoapObject_Order = new PlentySoapObject_Order();
		$oPlentySoapObject_Order->OrderItems = $this->createOrderItems($magento_order_info);
		$oPlentySoapObject_Order->OrderHead = $this->createOrderHead($magento_order_info, $plenty_customer_id);
		
		$oArrayOfPlentysoapobject_order = new ArrayOfPlentysoapobject_order();
		$oArrayOfPlentysoapobject_order->item = $oPlentySoapObject_Order;
		
		$oPlentySoapRequest_AddOrders = new PlentySoapRequest_AddOrders();
		$oPlentySoapRequest_AddOrders->Orders = $oArrayOfPlentysoapobject_order;
		
		$response = $this->getPlentySoap()->AddOrders($oPlentySoapRequest_AddOrders);
		return $response;
	}
	
	private function createOrderItems($magento_order_info){
		$oArrayOfPlentysoapobject_orderitem = new ArrayOfPlentysoapobject_orderitem();
		$i = 0;
		while($i < count($magento_order_info["items"])){
			$oPlentySoapObject_OrderItem = new PlentySoapObject_OrderItem ();
 			$oPlentySoapObject_OrderItem->ItemID = $this->getPlentyItemID($magento_order_info["items"][$i]["product_id"]);
			$oPlentySoapObject_OrderItem->Quantity = $magento_order_info["items"][$i]["qty_ordered"];
			$oPlentySoapObject_OrderItem->Price = floatval($magento_order_info["items"][$i]["price_incl_tax"]);
			$oPlentySoapObject_OrderItem->Currency = "EUR";

			$oArrayOfPlentysoapobject_orderitem->item[$i] = $oPlentySoapObject_OrderItem;
			$i++;
		}
		return $oArrayOfPlentysoapobject_orderitem;
	}
	
	private function addOrderNote($plenty_order_id, $order_note){
		$oPlentySoapRequestObject_AddOrderNotes = new PlentySoapRequestObject_AddOrderNotes();
		$oPlentySoapRequestObject_AddOrderNotes->OrderID = $plenty_order_id;
		$oPlentySoapRequestObject_AddOrderNotes->OrderNote = $order_note;
		$oPlentySoapRequestObject_AddOrderNotes->UserID = 5;
		
		$oArrayOfPlentysoaprequestobject_addordernotes = new ArrayOfPlentysoaprequestobject_addordernotes();
		$oArrayOfPlentysoaprequestobject_addordernotes->item = $oPlentySoapRequestObject_AddOrderNotes;
		
		$oPlentySoapRequest_AddOrderNotes = new PlentySoapRequest_AddOrderNotes();
		$oPlentySoapRequest_AddOrderNotes->AddOrderNotes = $oArrayOfPlentysoaprequestobject_addordernotes;
		
		$result = $this->getPlentySoap()->AddOrderNotes($oPlentySoapRequest_AddOrderNotes);
	}
	
	private function createOrderHead($magento_order_info, $plenty_customer_id){
		$oPlentySoapObject_OrderHead = new PlentySoapObject_OrderHead();
		$oPlentySoapObject_OrderHead->CustomerID = $plenty_customer_id;
		$oPlentySoapObject_OrderHead->ExternalOrderID = $magento_order_info["increment_id"];
		$oPlentySoapObject_OrderHead->ShippingCosts = $magento_order_info["shipping_incl_tax"];
		$oPlentySoapObject_OrderHead->DeliveryAddressID = $magento_order_info["shipping_address"]["address_id"];
 		$oPlentySoapObject_OrderHead->EstimatedTimeOfShipment = $magento_order_info["deliverydate"][0]["value"];
		$oPlentySoapObject_OrderHead->StoreID = 0;
		$oPlentySoapObject_OrderHead->WarehouseID = 1;
		
		if($magento_order_info["shipping_address"]["country_id"] == "DE"){
			$oPlentySoapObject_OrderHead->ShippingProfileID = 8;
		}else if($magento_order_info["shipping_address"]["country_id"] == "LU"){
			$oPlentySoapObject_OrderHead->ShippingProfileID = 10;
		}else if($magento_order_info["shipping_address"]["country_id"] == "AT"){
			$oPlentySoapObject_OrderHead->ShippingProfileID = 7;
		}
		
		$order_status = $magento_order_info["status"];
		if($order_status == "processing"){
			$oPlentySoapObject_OrderHead->OrderStatus = 4.1;
		}

		return $oPlentySoapObject_OrderHead;
	}
	
	private function createPlentyDeliveryAdress($magento_order_info, $plenty_customer_id){
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses  = new   PlentySoapRequest_ObjectSetCustomerDeliveryAddresses();
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->City = $magento_order_info["shipping_address"]["city"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Company = $magento_order_info["shipping_address"]["company"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CustomerID = $plenty_customer_id;
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Email = $magento_order_info["shipping_address"]["email"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Fax = $magento_order_info["shipping_address"]["fax"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->FirstName = $magento_order_info["shipping_address"]["firstname"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Surname = $magento_order_info["shipping_address"]["lastname"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->ExternalDeliveryAddressID = $magento_order_info["shipping_address"]["address_id"];
		$addrArr = $this->addressTool($magento_order_info["shipping_address"]["street"]);
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Street = $addrArr["street"];
		
		if(empty($addrArr["number"])){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->HouseNumber = " ";
		}else {
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->HouseNumber = $addrArr["number"];
		}
		
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Telephone = $magento_order_info["shipping_address"]["telephone"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->ZIP = $magento_order_info["shipping_address"]["postcode"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->DeliveryAddressID = $magento_order_info["shipping_address"]["address_id"];

		if($magento_order_info["shipping_address"]["country_id"] == "DE"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 1;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "DE";
		}else if($magento_order_info["shipping_address"]["country_id"] == "LU"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 17;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "LU";
		}else if($magento_order_info["shipping_address"]["country_id"] == "AT"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 2;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "AT";
		}
		
		$osetcustomerdeliveryaddresses = new   ArrayOfPlentysoaprequest_objectsetcustomerdeliveryaddresses();
		$osetcustomerdeliveryaddresses->item = $oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses;
		
		$oPlentySoapObject_DeliveryAddress = new PlentySoapRequest_SetCustomerDeliveryAddresses();
		$oPlentySoapObject_DeliveryAddress->DeliveryAddresses = $osetcustomerdeliveryaddresses;
		
		$response = $this->getPlentySoap()->SetCustomerDeliveryAddresses($oPlentySoapObject_DeliveryAddress);
		return $response->Success;
	}
	
	private function createPlentyCustomer($magento_order_info){
		$this->getLogger()->info(":: Erstelle/Update Kunde: FTC".$magento_order_info["customer_id"]);
		
		$oPlentySoapObject_Customer = new  PlentySoapObject_Customer();
		$oPlentySoapObject_Customer->Company = $magento_order_info["billing_address"]["company"];
		$oPlentySoapObject_Customer->CustomerNumber = 'FTC'.$magento_order_info["customer_id"];
		$oPlentySoapObject_Customer->CustomerID = $magento_order_info["customer_id"];
		$oPlentySoapObject_Customer->Email = $magento_order_info["billing_address"]["email"];
		$oPlentySoapObject_Customer->FirstName = $magento_order_info["billing_address"]["firstname"];
		$oPlentySoapObject_Customer->Surname = $magento_order_info["billing_address"]["lastname"];
		
		$addrArr = $this->addressTool($magento_order_info["billing_address"]["street"]);
		$oPlentySoapObject_Customer->Street = $addrArr["street"];
		$oPlentySoapObject_Customer->HouseNo = $addrArr["number"];
		
 		$oPlentySoapObject_Customer->City = $magento_order_info["billing_address"]["city"];
		$oPlentySoapObject_Customer->ZIP = $magento_order_info["billing_address"]["postcode"];
		$oPlentySoapObject_Customer->Telephone = $magento_order_info["billing_address"]["telephone"];
 		$oPlentySoapObject_Customer->Type = 0;
 		$oPlentySoapObject_Customer->FormOfAddress = 0;
 		
		if($magento_order_info["billing_address"]["country_id"] == "DE"){
 			$oPlentySoapObject_Customer->CountryID = 1;
 			$oPlentySoapObject_Customer->CountryISO2 = "DE";
 			$oPlentySoapObject_Customer->Language = "de";
 		}else if($magento_order_info["billing_address"]["country_id"] == "LU"){
 			$oPlentySoapObject_Customer->CountryID = 17;
 			$oPlentySoapObject_Customer->CountryISO2 = "LU";
 			$oPlentySoapObject_Customer->Language = "fr";
 		}else if($magento_order_info["billing_address"]["country_id"] == "AT"){
 			$oPlentySoapObject_Customer->CountryID = 2;
 			$oPlentySoapObject_Customer->CountryISO2 = "AT";
 			$oPlentySoapObject_Customer->Language = "de";
 		}
 		
 		$oArrayOfPlentysoapobject_customer = new ArrayOfPlentysoapobject_customer();
 		$oArrayOfPlentysoapobject_customer->item = $oPlentySoapObject_Customer;
 		
 		$oPlentySoapRequest_SetCustomers = new PlentySoapRequest_SetCustomers();
 		$oPlentySoapRequest_SetCustomers->Customers = $oArrayOfPlentysoapobject_customer;
 	
		$response = $this->getPlentySoap()->SetCustomers($oPlentySoapRequest_SetCustomers);
		if($response->Success){
			$i = 0;
			while($i < count($response->ResponseMessages->item)){
				if($response->ResponseMessages->item[$i]->IdentificationKey == "CustomerID"){
					return $response->ResponseMessages->item[$i]->IdentificationValue;
				}
				$i++;
			}
		}
	}
	
	private function addressTool($street){
		$value = $street;
		$spl = str_split($street);
		$pos = 0;
		$location = 0;

		foreach($spl as $char)
		{
			if(is_numeric($char) && $spl[$pos-1]==' ')
			{
				$location = $pos;
				break;
			}
			$pos++;
		}

		if(!$location)
		{
			if(is_numeric($spl[count($spl)-1])){
				for($c=count($spl)-1;$c>0;$c--) {
					if(is_numeric($spl[$c])) {
						continue;
					} else {
						$location = $c+1;
						break;
					}
				}
			}
		}
				
		if($location) {
			
			$street = substr($value,0,$location);
			$number = substr($value,$location);
		} else {
			$street = $value;
			$number = null;
		}
		
		$adressArr = array( 'street' => $street, 'number' => $number);
		return $adressArr;
	}
	
	private function getPlentyOrderInfos($magento_order_id){
		$query = 'SELECT  `plenty_order_id`, `plenty_customer_id` FROM `plenty_magento_orders_mapping`'.DBUtils::buildWhere( array( 'magento_order_id' => $magento_order_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result;
	}
	
	private function getPlentyCustomerByEmail($email){
		$oCustomersRequest = new PlentySoapRequest_GetCustomers();
		$oCustomersRequest->Email = $email;
		$response = $this->getPlentySoap()->GetCustomers($oCustomersRequest);
		return $response;
	}
	
	private function addOrderMapping($plenty_order_id, $magento_order_id, $plenty_customer_id, $magento_customer_id){
		if(!empty($plenty_order_id) && !empty($magento_order_id) && !empty($plenty_customer_id) && !empty($magento_customer_id)){
			$query = 'REPLACE INTO `plenty_magento_orders_mapping` '.DBUtils::buildInsert(	array(	'plenty_order_id' => $plenty_order_id, 'magento_order_id'	=>	$magento_order_id, 'plenty_customer_id' => $plenty_customer_id, 'magento_customer_id' => $magento_customer_id));
			$this->getLogger()->debug(__FUNCTION__.' '.$query);
			DBQuery::getInstance()->replace($query);
		}
	}
	
	private function getPlentyItemID($magento_item_id){
		$query = 'SELECT `plenty_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'magento_item_id' => $magento_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["plenty_item_id"];
	}
	
	private function getNewOrders(){
		$query = 'Select `order_id` FROM `magento_orders`';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$response = DBQuery::getInstance()->select($query);
		return $response;
	}
	
	private function removeOrderFromDatabase($magento_order_id){
		if(!empty($magento_order_id)){
			$query = 'DELETE FROM `magento_orders`'.DBUtils::buildWhere( array( 'order_id' => $magento_order_id));
			$this->getLogger()->debug(__FUNCTION__.' '.$query);
			DBQuery::getInstance()->delete($query);
		}
	}
}

?>