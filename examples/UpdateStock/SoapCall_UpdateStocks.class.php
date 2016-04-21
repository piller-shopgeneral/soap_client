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
		$magentoSoapClient = MagentoSoapClient::getInstance();
		$magentoSoapClient->doAuthentification();
		self::$magentoSession = $magentoSoapClient->getSession();
		self::$magentoClient = $magentoSoapClient->getSoapClient();
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
		
		$i = 0;
		while($i < $pages){
			
			$oPlentySoapRequest_GetCurrentStocks->Page = $i;
			$result = $this->getPlentySoap()->GetCurrentStocks($oPlentySoapRequest_GetCurrentStocks);
			
			$e = 0;
			while($e < count($result->CurrentStocks->item)){
				$plenty_item_id = explode('-', $result->CurrentStocks->item[$e]->SKU)[0];
				$stock = $result->CurrentStocks->item[$e]->PhysicalStock;
				$magento_item_id = $this->getMagentoItemID($plenty_item_id);
				$this->updateStock($magento_item_id, $stock);
				$e++;
			}
			$i++;
		}
		
		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
	}
	
	private function updateStock($magento_item_id, $stock){
		$stockItemData = array(
				'use_config_manage_stock' => 0,
		);
		
		$result = self::$magentoClient->call(
				self::$magentoSession,
				'product_stock.update',
				array(
						$magento_item_id,
						$stockItemData
				)
		);
	}
	
	private function getMagentoItemID($plenty_item_id){
		$query = 'SELECT `magento_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'plenty_item_id' => $plenty_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_item_id"];
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