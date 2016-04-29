<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateItemsImages extends PlentySoapCall {
	
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
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_UpdateItemsImages)) {
			self::$instance = new SoapCall_UpdateItemsImages();
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
			$this->getLogger()->info(":: Starte Update: Artikelbilder ::");
			$this->lastUpdateFrom = $this->checkLastUpdate();
			$this->lastUpdateTo = time();
			
			$imageItem = $this->getImages();
			
			$totalPages = $imageItem->Pages;
			
			$i = 0;
			while($i < $totalPages){
				$itemByPage = $this->getItemsImagesByPage($this->lastUpdateFrom, $this->lastUpdateTo, $i);
					
				$e = 0;
				while($e < count($itemByPage->ItemsImages->item)){
					$magento_item_id = $this->getMagentoItemID($itemByPage->ItemsImages->item[$e]->ItemID);
					$this->getLogger()->info("::  Neues Artikelbild: ".$itemBase->ItemID);
					$imageFile = $this->getImageFile($itemByPage->ItemsImages->item[$e]);
					$magento_file_name = $this->sendImageCall($magento_item_id, $imageFile);
					$this->getLogger()->info(":: Update Datenbank Mapping: ".$itemByPage->ItemsImages->item[$e]->ImageID." : ".$magento_item_id." : ".$magento_file_name);
					$this->addMapping($itemByPage->ItemsImages->item[$e]->ImageID, $magento_item_id, $magento_file_name);
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
		$this->getLogger()->info(":: Update: Artikelbilder  - beendet ::");
		echo "\n";
	}
	
	private function getImages() {
		$oPlentySoapRequest_GetItemsImages = new PlentySoapRequest_GetItemsImages ();
		$oPlentySoapRequest_GetItemsImages->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetItemsImages->LastUpdateTo = $this->lastUpdateTo;
		$response = $this->getPlentySoap()->GetItemsImages($oPlentySoapRequest_GetItemsImages);
		return $response;
	}
	
	public function getImgUrlToBase64($imgUrl) {
		$image = file_get_contents ( $imgUrl );
		if ($image !== false) {
			return base64_encode ( $image );
			
		}
	}
	
	public function getImageFile($imageItem){
		$imgData = $this->getImgUrlToBase64 ( $imageItem->ImageURL );
		$file = array (
				'content' => $imgData,
				'mime' => 'image/jpeg'
		);
		
		return $file;
	}
	
	public function sendImageCall($magento_item_id, $file){
		try{
			$result = self::$magentoClient->call ( self::$magentoSession, 'catalog_product_attribute_media.create', array (
					$magento_item_id,
					array (
							'file' => $file,
							'label' => 'PlentyMarkets Image',
							'position' => '100',
							'types' => array (
									'thumbnail',
									'small_image',
									'image'
							),
							'exclude' => 0
					)
			));
		}catch (Exception $e){
			$this->getLogger()->info("::  Exception: ".$e->getMessage()." (skip)");
		}
		return $result;
	}
	
	private function getItemsImagesByPage($lastUpdateFrom, $lastUpdateTill, $page){
		$oPlentySoapRequest_GetItemsImages = new PlentySoapRequest_GetItemsImages ();
		$oPlentySoapRequest_GetItemsImages->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetItemsImages->LastUpdateTo = $this->lastUpdateTo;
		$oPlentySoapRequest_GetItemsImages->Page = $page;
		$response = $this->getPlentySoap()->GetItemsImages($oPlentySoapRequest_GetItemsImages);
		return $response;
	}
	
	private function addMapping($plenty_image_id, $magento_item_id, $magento_file_name){
		if(!empty($plenty_image_id) && !empty($magento_item_id) && !empty($magento_file_name)){
			$query = 'INSERT INTO `plenty_magento_images_mapping` '.DBUtils::buildInsert(	array(	'plenty_image_id' => $plenty_image_id, 'magento_item_id' =>	$magento_item_id, 'magento_file_name' =>	$magento_file_name));
			$this->getLogger()->debug(__FUNCTION__.' '.$query);
			DBQuery::getInstance()->insert($query);
		}
	}
	
	private function getMagentoItemID($plenty_item_id){
		$query = 'SELECT `magento_item_id` FROM `plenty_magento_item_mapping`'.DBUtils::buildWhere( array( 'plenty_item_id' => $plenty_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["magento_item_id"];
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_itemsImages_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_itemsImages_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$this->lastUpdateTo));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
}

?>