<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_ImagesAbgleich extends PlentySoapCall {
	
	private static $instance = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	public function __construct() {
		parent::__construct ( __CLASS__ );
		$this->initMagentoController ();
	}
	
	public static function getInstance() {
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_ImagesAbgleich)) {
			self::$instance = new SoapCall_ImagesAbgleich();
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
		
		$plentyImageIdsCache = $this->getPlentyImageIDs();
		$magentoImagesIdsCache = $this->getMagentoImageIDs();
		
		$temp = array_diff($plentyImageIdsCache, $magentoImagesIdsCache);
		
		$i = 0;
		foreach($temp as &$id){
			$result[$i] = $id;
			$i++;
		}
		
		self::$magentoClient->endSession(self::$magentoSession);
	}
	
	private function getPlentyImageIDs(){
		
		$imageItem = $this->getImages();
		$totalPages = $imageItem->Pages;
		
		$plentyImageIds = array();
		$i = 0;
		$img = 0;
		
		while($i < $totalPages){
			$itemByPage = $this->getItemsImagesByPage($i);
				
			$e = 0;
			while($e < count($itemByPage->ItemsImages->item)){
				$plentyImageIds[$img] = $itemByPage->ItemsImages->item[$e]->ImageID;
				$e++;
				$img++;
			}
			$i++;
		}
		return $plentyImageIds;
	}
	
	private function getImages() {
		$oPlentySoapRequest_GetItemsImages = new PlentySoapRequest_GetItemsImages ();
		$oPlentySoapRequest_GetItemsImages->LastUpdateFrom = 0;
		$oPlentySoapRequest_GetItemsImages->LastUpdateTo = time();
		$response = $this->getPlentySoap()->GetItemsImages($oPlentySoapRequest_GetItemsImages);
		return $response;
	}
	
	private function getItemsImagesByPage($page){
		$oPlentySoapRequest_GetItemsImages = new PlentySoapRequest_GetItemsImages ();
		$oPlentySoapRequest_GetItemsImages->Page = $page;
		$oPlentySoapRequest_GetItemsImages->LastUpdateFrom = 0;
		$oPlentySoapRequest_GetItemsImages->LastUpdateTo = time();
		$response = $this->getPlentySoap()->GetItemsImages($oPlentySoapRequest_GetItemsImages);
		return $response;
	}
	
	private function getMagentoImageIDs(){
		$query = 'SELECT `plenty_image_id` FROM `plenty_magento_images_mapping`';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["plenty_image_id"];
	}
}

?>