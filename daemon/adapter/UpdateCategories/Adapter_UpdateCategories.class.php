<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';


/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_UpdateCategories extends PlentySoapCall 
{
	
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
		if (! isset ( self::$instance ) || ! (self::$instance instanceof Adapter_UpdateCategories)) {
			self::$instance = new Adapter_UpdateCategories();
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
			$this->getLogger()->info(":: Starte Update: Kategorien ::");
			$this->lastUpdateFrom = $this->checkLastUpdate();
			$this->lastUpdateTo = time();
			
			$response = $this->getPlentySoap()->GetCategoryPreview();
			
			$i = 0;
			while($i < count($response->CategoriesPreview->item)){
				if($response->CategoriesPreview->item[$i]->Name != NULL){
					$catArrIds[] = $response->CategoriesPreview->item[$i]->CategoryID;
					$catArrNames[$response->CategoriesPreview->item[$i]->CategoryID] = $response->CategoriesPreview->item[$i]->Name;
				}
				$i++;
			}
			
			$oPlentySoapRequest_GetCategories = new PlentySoapRequest_GetCategories();
			$oArrayOfPlentysoaprequestobject_getcategories = new ArrayOfPlentysoaprequestobject_getcategories();
			
			$i = 0;
			while($i < count($catArrIds)){
				$o = new PlentySoapRequestObject_GetCategories();
				$o->CategoryID = $catArrIds[$i];
				$oArrayOfPlentysoaprequestobject_getcategories->item[$i] = $o;
				$i++;
			}
					
			$oPlentySoapRequest_GetCategories->GetCategories = $oArrayOfPlentysoaprequestobject_getcategories;
			$response1 = $this->getPlentySoap()->GetCategories($oPlentySoapRequest_GetCategories);
			
			$i = 0;
			while($i < count($response1->Categories->item)){
				if($response1->Categories->item[$i]->LastUpdateTimestamp > $this->lastUpdateFrom){
					
					$category_id = $response1->Categories->item[$i]->CategoryID;
					$parent_id = $response1->Categories->item[$i]->ParentCategoryID;
					$item = $response1->Categories->item[$i];
					$updatedItems[] = $item;
					$name = $catArrNames[$category_id];
					
					if($this->categoryAlreadyExist($category_id)){
						$this->getLogger()->info(":: Update Kategorien: '.$name.' ::");
						$magentoCatID = $this->createMagentoCategory($item, $name, "update");
					}else {
						$this->getLogger()->info(":: Erstelle Kategorien: '.$name.' ::");
						$magentoCatID = $this->createMagentoCategory($item, $name, "neu");
					}
					$this->insertIDsIntoDB(
							$name,
							$category_id,
							$magentoCatID,
							$parent_id);
				}
				$i++;
			}
			
			if(!empty($updatedItems)){

				$i = 0;
				while($i < count($updatedItems)){
					$category_id = $updatedItems[$i]->CategoryID;
						
					$magento_id = $this->getMagentoID($category_id);
					$magento_parent_id = $this->getMagentoParentID($category_id);
						
					if($magento_parent_id != NULL){
						$successfull = $this->moveMagentoCategory($magento_id ,$magento_parent_id);
						if($successfull){
							$this->updateMagentoParentID($magento_id, $magento_parent_id);
						}
					}
					$i++;
				}
			}
		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}

		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Update: Kategorien  - beendet ::");
		echo "\n";
	}
	
	private function moveMagentoCategory($magentoCategoryID ,$magentoParentID){
		$result = self::$magentoClient->call(self::$magentoSession, 'catalog_category.move', array('categoryId' => $magentoCategoryID, 'parentId' => $magentoParentID));
		return $result;
	}
	
	private function createMagentoCategory($item, $name, $status){
		$category = array(
				'name' => $name,
				'available_sort_by' => 'position',
				'default_sort_by' => 'position',
				'is_active' => 1,
    			'include_in_menu' => 1,
		);

		if($status == "neu"){
			$catID = self::$magentoClient->call(self::$magentoSession, 'catalog_category.create', array(2, $category));
		}else {
			$catID = $this->getMagentoID($item->CategoryID);
			self::$magentoClient->call(self::$magentoSession, 'catalog_category.update', array($catID, $category));
		}
		
		return $catID;
	}
	
	private function categoryAlreadyExist($plentyID){
		$query = 'SELECT `magento_id` FROM `plenty_magento_category_mapping` WHERE `plenty_id` = '.$plentyID;
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		if($result->fetchAssoc() == NULL){
			return false;
		}else {
			return true;
		}
	}
	
	private function updateMagentoParentID($magentoCategoryID ,$magentoParentID){
		$query = 'UPDATE plenty_magento_category_mapping SET magento_parent = '.$magentoParentID.' WHERE magento_id = '.$magentoCategoryID;
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->update($query);
	}
	
	private function insertIDsIntoDB($catName, $plentyID, $magentoID, $plentyParent ){
		$query = 'REPLACE INTO `plenty_magento_category_mapping` '.DBUtils::buildInsert(	
				array(	'plenty_id' => $plentyID, 'magento_id'	=>	$magentoID, 'plenty_parent'	=>	$plentyParent, 'name' =>  $catName));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
	
	private function getMagentoID($plentyID){
		$query = 'SELECT `magento_id` FROM `plenty_magento_category_mapping` WHERE `plenty_id` = '.$plentyID;
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_id"];
	}
	
	private function getMagentoParentID($plentyID){
		$query = 'SELECT `magento_id` FROM `plenty_magento_category_mapping` WHERE `plenty_id` = (SELECT `plenty_parent` FROM `plenty_magento_category_mapping` WHERE `plenty_id` = '.$plentyID.')';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_id"];
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_category_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_category_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$lastUpdateTill));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
}

?>