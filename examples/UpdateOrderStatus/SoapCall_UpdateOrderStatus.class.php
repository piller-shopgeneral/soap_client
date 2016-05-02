<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateOrderStatus extends PlentySoapCall {
	
	private static $instance = null;
	
	private $lastUpdateFrom = null;
	private $lastUpdateTo = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	public function __construct() {
		parent::__construct ( __CLASS__ );
		$this->initMagentoController ();
	}
	
	public static function getInstance() {
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_UpdateOrderStatus)) {
			self::$instance = new SoapCall_UpdateOrderStatus();
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
		try
		{
			$this->getLogger()->info(":: Starte Update: Bestellstatus ::");
			$this->lastUpdateFrom = $this->checkLastUpdate();
			$this->lastUpdateTo = time();
			
			$pages = $this->getPlentyOrdersPages();
			
			$i = 0;
			while($i < $pages){
				$result = $this->getPlentyOrdersByPage($i);
				
				$e = 0;
				while($e < count($result->Orders->item)){
					$magento_order_id = $result->Orders->item[$e]->OrderHead->ExternalOrderID;
					$result = $this->setStatusComplete($magento_order_id);
					echo $result;
					$e++;
				}

				$i++;
			}
			
		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}
		
		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Update: Bestellstatus  - beendet ::");
		echo "\n";
	}
	
	private function setStatusComplete($magento_order_id){
		$success = self::$magentoClient->call(
				self::$magentoSession,
				'order_shipment.create',
				array(
						$magento_order_id
				)
		);
		
		return $success;
	}
	
	private function getPlentyOrdersPages(){
		$oPlentySoapRequest_SearchOrders = new PlentySoapRequest_SearchOrders();
		$oPlentySoapRequest_SearchOrders->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_SearchOrders->LastUpdateTill = $this->lastUpdateTo;
		$oPlentySoapRequest_SearchOrders->OrderStatus = 7;
		$result = $this->getPlentySoap()->SearchOrders($oPlentySoapRequest_SearchOrders);
		return $result->Pages;
	}
	
	private function getPlentyOrdersByPage($page){
		$oPlentySoapRequest_SearchOrders = new PlentySoapRequest_SearchOrders();
		$oPlentySoapRequest_SearchOrders->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_SearchOrders->LastUpdateTill = $this->lastUpdateTo;
		$oPlentySoapRequest_SearchOrders->OrderStatus = 7;
		$oPlentySoapRequest_SearchOrders->Page = $page;
		$result = $this->getPlentySoap()->SearchOrders($oPlentySoapRequest_SearchOrders);
		return $result;
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_status_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_status_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$this->lastUpdateTo));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
}

?>