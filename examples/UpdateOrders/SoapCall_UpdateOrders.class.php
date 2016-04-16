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
		
		$orderList = $this->getOrderList();
		
		
		
		while($magento_order_id = $orderList->fetchAssoc()){
			$result = self::$magentoClient->call(self::$magentoSession, 'sales_order.info', $magento_order_id);
			var_dump($result);
			
		}
	
		self::$magentoClient->endSession(self::$magentoSession);
		exit;
	}
	
	private function getOrderList(){
		$query = 'Select `order_id` FROM `magento_orders`';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$response = DBQuery::getInstance()->select($query);
		return $response;
	}
}

?>