<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateStocks extends PlentySoapCall {
	
	private static $_WAREHOUSE_ID = 1;
	
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
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_UpdateStocks)) {
			self::$instance = new SoapCall_UpdateStocks();
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
		$this->lastUpdateFrom = $this->checkLastUpdate();
		$this->lastUpdateTo = time();
		
		$oPlentySoapRequest_GetCurrentStocks = new PlentySoapRequest_GetCurrentStocks();
		$oPlentySoapRequest_GetCurrentStocks->LastUpdate = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetCurrentStocks->WarehouseID = self::$_WAREHOUSE_ID;
		
		$result = $this->getPlentySoap()->GetCurrentStocks($oPlentySoapRequest_GetCurrentStocks);
		$pages = $result->Pages;
		
		var_dump($result);
		exit;
		
		$i = 0;
		while($i < $pages){
			
			//  string(9) "258-242-0"
			//  258 = Plenty Item Id
			//  MagenID via PlentyID holen und Warenbestand setzen
			
			$result->CurrentStocks->item->SKU;
			
			var_dump($result);
			exit;
		}
		
		
		
		
		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_stock_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_stock_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$this->lastUpdateTo));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
}

?>