<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateCategories extends PlentySoapCall {
	
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
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_UpdateCategories)) {
			self::$instance = new SoapCall_UpdateCategories();
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
		
		$newUpdate = false;
		$updatedItems = array();
		
		$response = $this->getPlentySoap()->GetCategoryPreview();
		
		$i = 0;
		while($i < count($response->CategoriesPreview->item)){
			if($response->CategoriesPreview->item[$i]->Name != NULL){
				
				$oPlentySoapRequest_GetCategories = new PlentySoapRequest_GetCategories();
				$o = new PlentySoapRequestObject_GetCategories();
				$o->CategoryID = $response->CategoriesPreview->item[$i]->CategoryID;
				
				$name = $response->CategoriesPreview->item[$i]->Name;
				$oArrayOfPlentysoaprequestobject_getcategories = new ArrayOfPlentysoaprequestobject_getcategories();
				$oArrayOfPlentysoaprequestobject_getcategories->item = $o;
				$oPlentySoapRequest_GetCategories->GetCategories = $oArrayOfPlentysoaprequestobject_getcategories;
				$response1 = $this->getPlentySoap()->GetCategories($oPlentySoapRequest_GetCategories);
				
				if($response1->Categories->item[0]->LastUpdateTimestamp > $this->lastUpdateFrom){
					$updatedItems[$i] = $response1->Categories->item[0];
					$newUpdate = true;
					if($this->categoryAlreadyExist($response1->Categories->item[0]->CategoryID)){
						$magentoCatID = $this->createMagentoCategory($response1->Categories->item[0], $name, "update");
					}else {
						$magentoCatID = $this->createMagentoCategory($response1->Categories->item[0], $name, "neu");
					}
					$this->insertIDsIntoDB(
							$name, 
							$response1->Categories->item[0]->CategoryID, 
							$magentoCatID, 
							$response1->Categories->item[0]->ParentCategoryID);
				}
			}
			$i++;
		}
		
		$updatedItems = array_values($updatedItems);
		
		if($newUpdate){
			$j = 0;
			while($j < count($updatedItems)){
					$category_id = $updatedItems[$j]->CategoryID;
			
					$magento_id = $this->getMagentoID($category_id);
					$magento_parent_id = $this->getMagentoParentID($category_id);
			
					if($magento_parent_id != NULL){
						$successfull = $this->moveMagentoCategory($magento_id ,$magento_parent_id);
						if($successfull){
							$this->updateMagentoParentID($magento_id, $magento_parent_id);
						}
					}
				$j++;
			}
		}
		$this->setLastUpdate($this->lastUpdateTo);
	}
	
	private function moveMagentoCategory($magentoCategoryID ,$magentoParentID){
		$result = self::$magentoClient->call(self::$magentoSession, 'catalog_category.move', array('categoryId' => $magentoCategoryID, 'parentId' => $magentoParentID));
		return $result;
	}
	
	private function createMagentoCategory($item, $name, $status){
		
		$category = array(
				'name' => $name,
				'is_active' => 1,
    			'position' => 1,
    			'available_sort_by' => 'position',
   				'custom_design' => null,
   				'custom_apply_to_products' => null,
  				'custom_design_from' => null,
    			'custom_design_to' => null,
    			'custom_layout_update' => null,
    			'default_sort_by' => 'position',
    			'display_mode' => null,
    			'landing_page' => null,
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