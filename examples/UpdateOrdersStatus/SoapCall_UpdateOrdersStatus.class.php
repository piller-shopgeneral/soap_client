<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateOrdersStatus extends PlentySoapCall {
	
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

		
		self::$magentoClient->endSession(self::$magentoSession);
	}
	
	private function getPlentyItemID($magento_item_id){
		$query = 'SELECT `plenty_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'magento_item_id' => $magento_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["plenty_item_id"];
	}
}

?>