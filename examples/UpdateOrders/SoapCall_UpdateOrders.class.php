<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateOrders extends PlentySoapCall {
	
	private static $instance = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	public function __construct() {
		parent::__construct ( __CLASS__ );
		$this->initMagentoController ();
	}
	
	public static function getInstance() {
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_UpdateOrders)) {
			self::$instance = new SoapCall_UpdateOrders();
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
		
		$orderList = $this->getNewOrders();
		
		while($magento_order_id = $orderList->fetchAssoc()){

			$magento_order_info = self::$magentoClient->call(self::$magentoSession, 'sales_order.info', $magento_order_id);

			$plenty_customer_info = $this->getPlentyCustomerByEmail($magento_order_info["customer_email"]);
			
			
			var_dump($plenty_customer_info);
			exit;
			
			If($plenty_customer_info->Customers == NULL){
				# Neuer Kunde im Plenty
				$plenty_customer_id = $this->createPlentyCustomer($magento_order_info);
				$this->createPlentyCustomer($magento_order_info, $plenty_customer_id);
				$this->createPlentyDeliveryAdress($magento_order_info, $plenty_customer_id);
				$this->createPlentyOrder($plenty_customer_id, $magento_order_info);
			}else {
				# Bereits vorhandener Kunde im Plenty
				$plenty_customer_id = $plenty_customer_info->Customers->item[0]->CustomerID;
				$this->createPlentyCustomer($magento_order_info, $plenty_customer_id);
				$this->createPlentyDeliveryAdress($magento_order_info, $plenty_customer_id);
				$this->createPlentyOrder($plenty_customer_id, $magento_order_info);
			}
			
			$this->removeOrderFromDatabase($magento_order_id);
		}
	
		self::$magentoClient->endSession(self::$magentoSession);
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
	}
	
	private function createOrderItems($magento_order_info){
		$oArrayOfPlentysoapobject_orderitem = new ArrayOfPlentysoapobject_orderitem();
		$i = 0;
		while($i < count($magento_order_info["items"])){
			$oPlentySoapObject_OrderItem = new PlentySoapObject_OrderItem ();
			$oPlentySoapObject_OrderItem->OrderID = $magento_order_info["items"][$i]["order_id"];
			$oPlentySoapObject_OrderItem->ItemID = $this->getPlentyItemID($magento_order_info["items"][$i]["product_id"]);
			$oPlentySoapObject_OrderItem->SKU = $magento_order_info["items"][$i]["sku"];
			$oPlentySoapObject_OrderItem->Quantity = $magento_order_info["items"][$i]["qty_ordered"];
			$oPlentySoapObject_OrderItem->Price = $magento_order_info["items"][$i]["original_price"];
			$oPlentySoapObject_OrderItem->WarehouseID = 1;
			$oArrayOfPlentysoapobject_orderitem->item[$i] = $oPlentySoapObject_OrderItem;
			$i++;
		}
		return $oArrayOfPlentysoapobject_orderitem;
	}
	
	private function createOrderHead($magento_order_info, $plenty_customer_id){
		$oPlentySoapObject_OrderHead = new PlentySoapObject_OrderHead();
		$oPlentySoapObject_OrderHead->CustomerID = $plenty_customer_id;
		$oPlentySoapObject_OrderHead->ExternalOrderID = $magento_order_info["increment_id"];
		$oPlentySoapObject_OrderHead->OrderID = $magento_order_info["order_id"];
		$oPlentySoapObject_OrderHead->ShippingCosts = $magento_order_info["shipping_incl_tax"];
		$oPlentySoapObject_OrderHead->DeliveryAddressID = $magento_order_info["shipping_address"]["address_id"];
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
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->HouseNumber = $addrArr["number"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->Telephone = $magento_order_info["shipping_address"]["telephone"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->ZIP = $magento_order_info["shipping_address"]["postcode"];
		$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->DeliveryAddressID = $magento_order_info["shipping_address"]["address_id"];

		if($magento_order_info["shipping_address"]["country_id"] == "EN"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 12;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "GB";
		}else if($magento_order_info["shipping_address"]["country_id"] == "FR"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 10;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "FR";
		}else if($magento_order_info["shipping_address"]["country_id"] == "DE"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 1;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "DE";
		}else if($magento_order_info["shipping_address"]["country_id"] == "LU"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 17;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "LU";
		}else if($magento_order_info["shipping_address"]["country_id"] == "AT"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 2;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "AT";
		}else if($magento_order_info["shipping_address"]["country_id"] == "CH"){
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryID = 1;
			$oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses->CountryISO2 = "CH";
		}
		
		
		$osetcustomerdeliveryaddresses = new   ArrayOfPlentysoaprequest_objectsetcustomerdeliveryaddresses();
		$osetcustomerdeliveryaddresses->item = $oPlentySoapRequest_ObjectSetCustomerDeliveryAddresses;
		
		$oPlentySoapObject_DeliveryAddress = new PlentySoapRequest_SetCustomerDeliveryAddresses();
		$oPlentySoapObject_DeliveryAddress->DeliveryAddresses = $osetcustomerdeliveryaddresses;
		
		$response = $this->getPlentySoap()->SetCustomerDeliveryAddresses($oPlentySoapObject_DeliveryAddress);
		return $response->Success;
	}
	
	private function createPlentyCustomer($magento_order_info, $plenty_order_id){	
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
 		
 		if($magento_order_info["billing_address"]["country_id"] == "EN"){
 			$oPlentySoapObject_Customer->Language = "en";
 			$oPlentySoapObject_Customer->CountryID = 12;
 			$oPlentySoapObject_Customer->CountryISO2 = "GB";
 		}else if($magento_order_info["billing_address"]["country_id"] == "FR"){
 			$oPlentySoapObject_Customer->CountryISO2 = "FR";
 			$oPlentySoapObject_Customer->Language = "fr";
 			$oPlentySoapObject_Customer->CountryID = 10;
 		}else if($magento_order_info["billing_address"]["country_id"] == "DE"){
 			$oPlentySoapObject_Customer->CountryID = 1;
 			$oPlentySoapObject_Customer->Language = "de";
 			$oPlentySoapObject_Customer->CountryISO2 = "DE";
 		}
 		
 		$oArrayOfPlentysoapobject_customer = new ArrayOfPlentysoapobject_customer();
 		$oArrayOfPlentysoapobject_customer->item = $oPlentySoapObject_Customer;
 		
 		$oPlentySoapRequest_SetCustomers = new PlentySoapRequest_SetCustomers();
 		$oPlentySoapRequest_SetCustomers->Customers = $oArrayOfPlentysoapobject_customer;
 	
		$response = $this->getPlentySoap()->SetCustomers($oPlentySoapRequest_SetCustomers);
		return $response->Success;
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
	
	private function getPlentyCustomerByEmail($email){
		$oCustomersRequest = new PlentySoapRequest_GetCustomers();
		$oCustomersRequest->Email = $email;
		$response = $this->getPlentySoap()->GetCustomers($oCustomersRequest);
		return $response;
	}
	
	private function getNewOrders(){
		$query = 'Select `order_id` FROM `magento_orders`';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$response = DBQuery::getInstance()->select($query);
		return $response;
	}
	
	private function getPlentyItemID($magento_item_id){
		$query = 'SELECT `plenty_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'magento_item_id' => $magento_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["plenty_item_id"];
	}
	
	private function removeOrderFromDatabase($magento_order_id){
		$query = 'DELETE FROM `magento_orders`'.DBUtils::buildWhere( array( 'order_id' => $magento_order_id["increment_id"]));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->delete($query);
	}
}

?>