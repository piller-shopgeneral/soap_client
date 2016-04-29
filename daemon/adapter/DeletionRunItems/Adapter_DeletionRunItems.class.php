<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';


/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_DeletionRunItems extends PlentySoapCall 
{
	
	private static $instance = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	public function __construct() {
		parent::__construct ( __CLASS__ );
		$this->initMagentoController ();
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
			$this->getLogger()->info(":: Starte Loeschvorgang: Artikel ::");
			
			$plentyItemIdsCache = $this->getPlentyItemIDs();
			
			$magentoItemIdsCache = array();
			
			$temp = $this->getMagentoItemIDs();
			
			$a = 0;
			while($row = $temp->fetchAssoc()){
				$magentoItemIdsCache[$a] = $row["plenty_item_id"];
				$a++;
			}
			
			if(!empty($magentoItemIdsCache) && !empty($plentyItemIdsCache)){
				
				$temp = array_diff($magentoItemIdsCache, $plentyItemIdsCache);
				
				$b = 0;
				foreach($temp as &$id){
					$result[$b] = $id;
					$b++;
				}
					
				$c = 0;
				while($c < count($result)){
					
					$magento_item_id = $this->getMagentoItemId($result[$c]);
					
					$success = $this->removeItemFromMagento($magento_item_id);
					
					if($success){
						$this->removeMapping($result[$c]);
						$this->getLogger()->info(":: Loesche Artikel: Magento Artikel ".$magento_item_id);
					}
					$c++;
				}
			}
		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}
		
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Loeschvorgang: Artikelbilder  - beendet ::");
		echo "\n";
	}
	
	private function removeItemFromMagento($magento_item_id){
		$result = self::$magentoClient->call(self::$magentoSession, 'catalog_product.delete', $magento_item_id);
		return $result;
	}
	
	private function getPlentyItemIDs(){
		
		$items = $this->getItems();
		$totalPages = $items->Pages;
		
		$plentyItemIds = array();
		$i = 0;
		$item = 0;
		while($i < $totalPages){
			$itemByPage = $this->getItemsByPage($i);
			
			$e = 0;
			while($e < count($itemByPage->ItemsBase->item)){
				$plentyItemIds[$item] = $itemByPage->ItemsBase->item[$e]->ItemID;
				$e++;
				$item++;
			}
			$i++;
		}
		return $plentyItemIds;
	}
	
	private function getItems() {
		$oPlentySoapRequest_GetItemsBase = new PlentySoapRequest_GetItemsBase();
		$oPlentySoapRequest_GetItemsBase->LastUpdateFrom = 0;
		$oPlentySoapRequest_GetItemsBase->LastUpdateTo = time();
		$response = $this->getPlentySoap()->GetItemsBase($oPlentySoapRequest_GetItemsBase);
		return $response;
	}
	
	private function getItemsByPage($page){
		$oPlentySoapRequest_GetItemsBase = new PlentySoapRequest_GetItemsBase();
		$oPlentySoapRequest_GetItemsBase->Page = $page;
		$oPlentySoapRequest_GetItemsBase->LastUpdateFrom = 0;
		$oPlentySoapRequest_GetItemsBase->LastUpdateTo = time();
		$response = $this->getPlentySoap()->GetItemsBase($oPlentySoapRequest_GetItemsBase);
		return $response;
	}
	
	private function getMagentoItemIDs(){
		$query = 'SELECT `plenty_item_id` FROM `plenty_magento_item_mapping`';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result;
	}
	
	private function removeMapping($plenty_item_id){
		if(!empty($plenty_item_id)){
			$query = 'DELETE FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'plenty_item_id' => $plenty_item_id));
			$this->getLogger()->debug(__FUNCTION__.' '.$query);
			$result = DBQuery::getInstance()->delete($query);
		}
	}
	
	private function getMagentoItemID($plenty_item_id){
		$query = 'SELECT `magento_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'plenty_item_id' => $plenty_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_item_id"];
	}
}

?>