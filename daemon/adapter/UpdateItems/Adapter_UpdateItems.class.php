<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';

/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_UpdateItems extends PlentySoapCall 
{
	private static $instance = null;
	private $value = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	private $lastUpdateFrom = null;
	private $lastUpdateTo = null;
	
	public function __construct()
	{
		parent::__construct(__CLASS__);
		$this->initMagentoController();
	}
	
	public static function getInstance()
	{
		if( !isset(self::$instance) || !(self::$instance instanceof SoapCall_UpdateItems) )
		{
			self::$instance = new SoapCall_UpdateItems();
		}
		return self::$instance;
	}
	
	private function initMagentoController(){
		$magentoSoapClient = MagentoSoapClient::getInstance();
		$magentoSoapClient->doAuthentification();
		self::$magentoSession = $magentoSoapClient->getSession();
		self::$magentoClient = $magentoSoapClient->getSoapClient();
	}
	
	/* (non-PHPdoc)
	 * @see PlentySoapCall::execute()
	 */
	public function execute() {
		// TODO Auto-generated method stub
		try
		{
			$this->lastUpdateFrom = $this->checkLastUpdate();
			$this->lastUpdateTo = time();
			
			$itemsBaseResponse = $this->getItemsBase($this->lastUpdateFrom, $this->lastUpdateTo);
			
			$totalPages = $itemsBaseResponse->Pages-1;
			$i = 0;
			while($i <= $totalPages){

				$itemsBaseByPageResponse = $this->getItemsBaseByPage($this->lastUpdateFrom, $this->lastUpdateTo, $i);

				if( $itemsBaseByPageResponse->Success == true )
				{
					$this->getLogger()->info(__FUNCTION__.':: Request Page: '.$i.' :: Success');
					$this->parseResponse($itemsBaseByPageResponse);
				}
				else
				{
					$this->getLogger()->debug(__FUNCTION__.' Request Error');
				}
				
				$i++;
			}

		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}
		
	  	$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
	}
		
	private function parseResponse($response)
	{
		if(is_array($response->ItemsBase->item))
		{
			foreach ($response->ItemsBase->item as $itemBase)
			{
				$this->getLogger()->info(__FUNCTION__.'::  Starte Update for'.' ItemID: '.$itemBase->ItemID);
				$magentoItem = $this->convertToMagentoItem($itemBase);
				$magentoItemID = $this->pushItemToMagento($magentoItem);
				if($magentoItemID != 1 && $magentoItemID != 0){
					$this->getLogger()->info(__FUNCTION__.':: Add Item to mapping Table: '.$itemBase->ItemID.' :: '.$magentoItemID);
					$this->addDBMapping($itemBase->ItemID, $magentoItemID);
				}else {
					if($magentoItemID == 1)
						$this->getLogger()->info(__FUNCTION__.':: Item Updated: ');
				}
			}
		}
	}
	
	private function getItemsBase($lastUpdateFrom, $lastUpdateTill){
		$oPlentySoapRequest_GetItemsBase = new PlentySoapRequest_GetItemsBase();
		$oPlentySoapRequest_GetItemsBase->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetItemsBase->LastUpdateTill = $lastUpdateTill;
		$response = $this->getPlentySoap()->GetItemsBase($oPlentySoapRequest_GetItemsBase);
		return $response;
	}
	
	private function getItemsBaseByPage($lastUpdateFrom, $lastUpdateTill, $page){
		$oPlentySoapRequest_GetItemsBase = new PlentySoapRequest_GetItemsBase();
		$oPlentySoapRequest_GetItemsBase->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetItemsBase->LastUpdateTill = $lastUpdateTill;
		$oPlentySoapRequest_GetItemsBase->Page = $page;
		$oPlentySoapRequest_GetItemsBase->GetCategories = true;
		$response = $this->getPlentySoap()->GetItemsBase($oPlentySoapRequest_GetItemsBase);
		return $response;
	}
	
	private function getItemTexts($itemID){
		$oPlentySoapObject_RequestItems = new PlentySoapObject_RequestItems();
		$oPlentySoapObject_RequestItems->ItemId = $itemID;
		$oPlentySoapObject_RequestItems->Lang = "en";
			
		$oArrayOfPlentysoapobject_requestitems = new ArrayOfPlentysoapobject_requestitems();
		$oArrayOfPlentysoapobject_requestitems->item = $oPlentySoapObject_RequestItems;
		
		$oPlentySoapRequest_GetItemsTexts = new PlentySoapRequest_GetItemsTexts();
		$oPlentySoapRequest_GetItemsTexts->ItemsList = $oArrayOfPlentysoapobject_requestitems;
		
		$response	=	$this->getPlentySoap()->GetItemsTexts($oPlentySoapRequest_GetItemsTexts);
		return $response;
	}
	
	private function pushItemToMagento($magentoItem){
		$attributeSets = self::$magentoClient->call(self::$magentoSession, 'product_attribute_set.list');
		$attributeSet = current($attributeSets);
	
		try{
			$result = self::$magentoClient->call(self::$magentoSession, 'catalog_product.create', $magentoItem->getProductCreateEntityArray("neu", $attributeSet));
		} catch(Exception $e)
		{
			if($e->getMessage() === "Der Wert des Attributs \"SKU\" muss einmalig sein."){
				$result = self::$magentoClient->call(self::$magentoSession, 'catalog_product.update', $magentoItem->getProductCreateEntityArray("update", $attributeSet));
			}
		}
		return $result;
	}
	
	private function getCategoryIDArray($itemBase){
		$fullPath = '';
		$i = 0;
		
		while($i < count($itemBase->Categories->item)){
			if($itemBase->Categories->item[$i]->ItemCategoryPath != NULL){
				$fullPath = $fullPath.$itemBase->Categories->item[$i]->ItemCategoryPath.';';
			}else {
				$fullPath = $fullPath.$itemBase->Categories->item[$i]->ItemCategoryID.';';
			}
			$i++;
		}
		
		$fullPath = str_replace(';', ' ', $fullPath);
		$test = explode(' ', $fullPath);
		$test = array_unique($test);
		$trunc_array = array_slice($test, 0, count($test)-1, true);
		$sortiert = array_values($trunc_array);
		return $sortiert;
	}
	
	private function convertToMagentoItem($itemBase){
		
		$idArr = $this->getCategoryIDArray($itemBase);
 		$magento_category_ids = $this->getMagentoCategoryID($idArr);

		$itemTexts = $this->getItemTexts($itemBase->ItemID);
		
		$item = new MagentoItem();
		$item->setSKU($itemBase->ItemNo);
		$item->setName($itemTexts->ItemTexts->item[0]->Name);
		$item->setCategory($magento_category_ids);
		$item->setDescription($itemTexts->ItemTexts->item[0]->LongDescription);
		$item->setShortDescription($itemTexts->ItemTexts->item[0]->MetaDescription); //$itemTexts->ItemTexts->item[0]->ShortDescription
		$item->setWeight($itemBase->PriceSet->WeightInGramm);
		if($itemBase->Availability->Inactive === 0){
			$item->setStatus(1);
		}else {
			$item->setStatus(0);
		}
		$item->setUrlKey($itemTexts->ItemTexts->item[0]->UrlContent);
		$item->setPrice($itemBase->PriceSet->Price);
		
		if($itemBase->PriceSet->Price1 == 0){
			$item->setSpecialPrice($itemBase->PriceSet->Price);
		}else {
			$item->setSpecialPrice($itemBase->PriceSet->Price1);
		}
		
		if($itemBase->PriceSet->VAT == 7){
			$item->setTaxClassId(2);
		} elseif ($itemBase->PriceSet->VAT == 19){
			$item->setTaxClassId(1);
		}else {
			$item->setTaxClassId(0);
		}
		
		$item->setMetaTitle($itemBase->Texts->Name);
		$item->setMetaKeyword($itemBase->Texts->Keywords);
		$item->setMetaDescription($itemTexts->ItemTexts->item[0]->MetaDescription);
		
		return $item;
	}
	
	private function addDBMapping($plentyItemID, $magentoItemID){
		$query = 'REPLACE INTO `plenty_magento_item_mapping` '.DBUtils::buildInsert(	array(	'plenty_item_id' => $plentyItemID, 'magento_item_id'	=>	$magentoItemID));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->replace($query, 'DBQueryResult');
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_items_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_items_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$lastUpdateTill));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
	
	private function getMagentoCategoryID($plenty_category_id){
		$ids = array();
		$i = 0;
		while($i < count($plenty_category_id)){
			$query = 'SELECT `magento_id` FROM `plenty_magento_category_mapping`'.DBUtils::buildWhere( array( 'plenty_id' => $plenty_category_id[$i]));
			$this->getLogger()->debug(__FUNCTION__.' '.$query);
			$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
			while ($row = $result->fetchAssoc()){
				$ids[count($ids)] = $row["magento_id"];
			}
			$i++;
		}
		return $ids;
	}
}

?>