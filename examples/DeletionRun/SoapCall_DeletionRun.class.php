<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_DeletionRun extends PlentySoapCall {
	
	private static $_CATEGORY = 1;
	private static $_ITEM = 5;
	
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
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_DeletionRun)) {
			self::$instance = new SoapCall_DeletionRun();
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
		
		$oPlentySoapRequest_GetDeleteLog = new PlentySoapRequest_GetDeleteLog();
		$oPlentySoapRequest_GetDeleteLog->TimestampFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetDeleteLog->TimestampTo = $this->lastUpdateTo;
		
		$response = $this->getPlentySoap()->GetDeleteLog($oPlentySoapRequest_GetDeleteLog);
		
		$i = 0;
		while($i < count($response->DeleteLogList->item)){
			$referenceType = $response->DeleteLogList->item[$i]->ReferenceType;
			$id = $response->DeleteLogList->item[$i]->ReferenceValue;
			
			if($referenceType == self::$_ITEM){
				$this->deleteItem($id);
			}elseif($referenceType == self::$_CATEGORY){
				$this->deleteCategory($id);
			}
			$i++;
		}
		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
	}
	
	private function deleteImage($plenty_item_id){
		$magento_item_id = $this->getMagentoItemID($plenty_item_id);
		$result = self::$magentoClient->call(self::$magentoSession, 'catalog_product_attribute_media.remove', array('product' => $magento_item_id, 'file' => '/i/m/image_344.jpg'));
	}
	
	private function deleteItem($plenty_item_id){
		$result = false;
		$magento_item_id = $this->getMagentoItemID($plenty_item_id);
		if($magento_item_id != NULL){
			$result = self::$magentoClient->call(self::$magentoSession, 'catalog_product.delete', $magento_item_id);
		}
		if ($result) {
			$this->getLogger ()->info ( __FUNCTION__ . ':: Deleted Magento Item: ' . $magento_item_id );
			$this->deleteItemIdFromDB($plenty_item_id);
		} else {
			$this->getLogger ()->info ( __FUNCTION__ . ':: Magento Item ' . $magento_item_id . ' not exist (skip)' );
		}
	}
	
	private function deleteCategory($plenty_category_id){
		$result = false;
		$magento_category_id = $this->getMagentoCategoryID($plenty_category_id);
		if($magento_category_id != NULL){
			try{
				$result = self::$magentoClient->call(self::$magentoSession, 'catalog_category.delete', $magento_category_id);
			}catch (Exception $e){
				$this->getLogger ()->info ( __FUNCTION__ . ':: '.$e->getMessage());
			}
		}
		if ($result) {
			$this->getLogger ()->info ( __FUNCTION__ . ':: Deleted Magento Category: ' . $magento_category_id );
			$this->deleteCategoryIdFromDB($plenty_category_id);
		} else {
			$this->getLogger ()->info ( __FUNCTION__ . ':: Magento Item ' . $magento_category_id . ' not exist (skip)' );
		}
	}
	
	private function getMagentoItemID($plenty_item_id){
		$query = 'SELECT `magento_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'plenty_item_id' => $plenty_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_item_id"];
	}
	
	private function getMagentoCategoryID($plenty_category_id){
		$query = 'SELECT `magento_id` FROM `plenty_magento_category_mapping`'.DBUtils::buildWhere( array( 'plenty_id' => $plenty_category_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_id"];
	}
	
	private function deleteCategoryIdFromDB($plenty_category_id){
		$query = 'DELETE FROM `plenty_magento_category_mapping`'.DBUtils::buildWhere( array( 'plenty_id' => $plenty_category_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->delete($query);
	}
	
	private function deleteItemIdFromDB($plenty_item_id){
		$query = 'DELETE FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'plenty_item_id' => $plenty_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->delete($query);
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_deletion_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_deletion_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$this->lastUpdateTo));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
}

?>