<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';

/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_UpdateItemsImages extends PlentySoapCall 
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
		$this->lastUpdateFrom = $this->checkLastUpdate();
		$this->lastUpdateTo = time();
	
		$imageItem = $this->getImages();
	
		$totalPages = $imageItem->Pages;
	
		$i = 0;
		while($i < $totalPages){
			$itemByPage = $this->getItemsImagesByPage($this->lastUpdateFrom, $this->lastUpdateTo, $i);
	
			$e = 0;
			while($e < count($itemByPage->ItemsImages->item)){
				var_dump($itemByPage->ItemsImages->item[$e]->Names);
				
				exit;
				$sku = $this->getSKUfromItemID($itemByPage->ItemsImages->item[$e]->ItemID);
				$this->getLogger()->info(__FUNCTION__.'::  Add Image for'.' Item: '.$sku);
				$imageFile = $this->getImageFile($itemByPage->ItemsImages->item[$e]);
				$this->sendImageCall($sku, $imageFile);
				$e++;
			}
				
			$i++;
		}
		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
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
	
	public function getSKUfromItemID($itemID){
		$oPlentySoapRequest_SearchItemsSKU = new PlentySoapRequest_SearchItemsSKU();
		$oPlentySoapRequest_SearchItemsSKU->ItemID = $itemID;
		$response = $this->getPlentySoap()->SearchItemsSKU($oPlentySoapRequest_SearchItemsSKU);
		return $response->ItemsList->item[0]->ItemNo;
	}
	
	public function getImageFile($imageItem){
		$imgData = $this->getImgUrlToBase64 ( $imageItem->ImageURL );
		$file = array (
				'content' => $imgData,
				'mime' => 'image/jpeg'
		);
		
		return $file;
	}
	
	public function sendImageCall($sku, $file){
		try{
			$result = self::$magentoClient->call ( self::$magentoSession, 'catalog_product_attribute_media.create', array (
					$sku,
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
	}
	
	private function getItemsImagesByPage($lastUpdateFrom, $lastUpdateTill, $page){
		$oPlentySoapRequest_GetItemsImages = new PlentySoapRequest_GetItemsImages ();
		$oPlentySoapRequest_GetItemsImages->LastUpdateFrom = $this->lastUpdateFrom;
		$oPlentySoapRequest_GetItemsImages->LastUpdateTo = $this->lastUpdateTo;
		$oPlentySoapRequest_GetItemsImages->Page = $page;
		$response = $this->getPlentySoap()->GetItemsImages($oPlentySoapRequest_GetItemsImages);
		return $response;
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