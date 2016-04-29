<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';


/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_DeletionRunCategories extends PlentySoapCall 
{
	
	private static $_CATEGORY = 1;
	
	private static $instance = null;
	
	private $lastUpdateFrom = null;
	private $lastUpdateTo = null;
	
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
		try
		{
			$this->getLogger()->info(":: Starte Loeschvorgang: Kategorien ::");
			
			$this->lastUpdateFrom = $this->checkLastUpdate();
			$this->lastUpdateTo = time();
			
			$oPlentySoapRequest_GetDeleteLog = new PlentySoapRequest_GetDeleteLog();
			$oPlentySoapRequest_GetDeleteLog->TimestampFrom = $this->lastUpdateFrom;
			$oPlentySoapRequest_GetDeleteLog->TimestampTo = $this->lastUpdateTo;
			$oPlentySoapRequest_GetDeleteLog->ReferenceType = self::$_CATEGORY;
			
			$response = $this->getPlentySoap()->GetDeleteLog($oPlentySoapRequest_GetDeleteLog);
			
			$i = 0;
			while($i < count($response->DeleteLogList->item)){
				$id = $response->DeleteLogList->item[$i]->ReferenceValue;
				$this->deleteCategory($id);
				$i++;
			}
		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}
		
		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Loeschvorgang: Kategorien  - beendet ::");
		echo "\n";
	}
	
	private function deleteCategory($plenty_category_id){
		$magento_category_id = $this->getMagentoCategoryID($plenty_category_id);
		if(!empty($magento_category_id)){
			try{
				$result = self::$magentoClient->call(self::$magentoSession, 'catalog_category.delete', $magento_category_id);
			}catch (Exception $e){
				$this->getLogger ()->info ( __FUNCTION__ . ':: '.$e->getMessage());
			}
		}
		if ($result) {
			$this->getLogger ()->info ( __FUNCTION__ . ':: Deleted Magento Category: ' . $magento_category_id );
			$this->removeMapping($plenty_category_id);
		} else {
			$this->getLogger ()->info ( __FUNCTION__ . ':: Magento Category ' . $magento_category_id . ' not exist (skip)' );
		}
	}
	
	private function getMagentoCategoryID($plenty_category_id){
		$query = 'SELECT `magento_id` FROM `plenty_magento_category_mapping`'.DBUtils::buildWhere( array( 'plenty_id' => $plenty_category_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_id"];
	}
	
	private function removeMapping($plenty_category_id){
		$query = 'DELETE FROM `plenty_magento_category_mapping`'.DBUtils::buildWhere( array( 'plenty_id' => $plenty_category_id));
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