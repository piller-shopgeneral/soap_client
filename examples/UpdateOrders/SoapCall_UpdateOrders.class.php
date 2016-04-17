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
			
			If($plenty_customer_info->Customers == NULL){
				$this->createPlentyCustomer($magento_order_info);
				
			}else {
				$plenty_customer_id = $plenty_customer_info->Customers->item[0]->CustomerID;
				# Customer Update
			}
			exit;
		}
	
		self::$magentoClient->endSession(self::$magentoSession);
		exit;
	}
	
	private function createPlentyCustomer($magento_order_info){
		$oSetCustomerRequest = new PlentySoapRequest_SetCustomers();
		$oPlentySoapObject_Customer = new PlentySoapObject_Customer();
		$oPlentySoapObject_Customer->Company = $magento_order_info["billing_address"]["company"];
		$oPlentySoapObject_Customer->CountryID = $magento_order_info["billing_address"]["country_id"];
		$oPlentySoapObject_Customer->CustomerNumber = $magento_order_info["customer_id"];
		$oPlentySoapObject_Customer->Email = $magento_order_info["billing_address"]["email"];
		$oPlentySoapObject_Customer->FirstName = $magento_order_info["billing_address"]["firstname"];
		$oPlentySoapObject_Customer->Surname = $magento_order_info["billing_address"]["lastname"];
		$addrArr = $this->addressTool($magento_order_info["billing_address"]["street"]);
		$oPlentySoapObject_Customer->Street = $addrArr["street"];
		$oPlentySoapObject_Customer->HouseNo = $addrArr["number"];
 		$oPlentySoapObject_Customer->City = $magento_order_info["billing_address"]["city"];
		$oPlentySoapObject_Customer->ZIP = $magento_order_info["billing_address"]["postcode"];
		$oPlentySoapObject_Customer->Telephone = $magento_order_info["billing_address"]["telephone"];
 		$oPlentySoapObject_Customer->Type = 2;
 		$oPlentySoapObject_Customer->FormOfAddress = 0;
 		$oPlentySoapObject_Customer->Language = "Deutsch";
		
		$a = new ArrayOfPlentysoapobject_customer();
		$a->item[0] = $oPlentySoapObject_Customer;
		
		$oSetCustomerRequest = new PlentySoapRequest_SetCustomers();
		$oSetCustomerRequest->Customers = $a;
		
		$response = $this->getPlentySoap()->SetCustomers($oSetCustomerRequest);
		
		var_dump($response);
		exit;
		
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
}

?>