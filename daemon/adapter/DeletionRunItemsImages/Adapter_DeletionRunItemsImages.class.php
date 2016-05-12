<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';


/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_DeletionRunItemsImages extends PlentySoapCall 
{
	
	private static $instance = null;
	
	private static $magentoClient = null;
	private static $magentoSession = null;
	
	public function __construct() {
		parent::__construct ( __CLASS__ );
		$this->initMagentoController ();
	}
	
	public static function getInstance() {
		if (! isset ( self::$instance ) || ! (self::$instance instanceof Adapter_DeletionRunItemsImages)) {
			self::$instance = new Adapter_DeletionRunItemsImages();
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
		try{
			$this->getLogger()->info(":: Starte Loeschvorgang: Artikelbilder ::");
			
			$plentyImageIdsCache = $this->getPlentyImageIDs();
			$magentoImagesIdsCache = array();
			
			$temp = $this->getMagentoImageIDs();
			
			$a = 0;
			while($row = $temp->fetchAssoc()){
				$magentoImagesIdsCache[$a] = $row["plenty_image_id"];
				$a++;
			}
			
			$temp = array_diff($magentoImagesIdsCache, $plentyImageIdsCache);
			
			$b = 0;
			foreach($temp as &$id){
				$result[$b] = $id;
				$b++;
			}
			
			$c = 0;
			while($c < count($result)){
				$imgData = $this->getMagentoImageData($result[$c]);
					
				while ($row = $imgData->fetchAssoc())
				{
					$tmp[] = $row;
				}
					
				$magento_image_name = $tmp[0]["magento_file_name"];
				$magento_item_id = $tmp[0]["magento_item_id"];
					
				$success = $this->removeImageFromMagento($magento_image_name, $magento_item_id);
				if($success){
					$this->removeImageFromDB($result[$c]);
					$this->getLogger()->info(":: Loesche Artikelbild: ".$magento_image_name." (Magento Artikel ".$magento_item_id.")");
					
					$itemImages = $this->getImagesByItem($magento_item_id);
					
					if($itemImages->getNumRows() > 0){
						while($row = $itemImages->fetchAssoc()){
							$tmp2[] = $row;
						}
						
						$productId = $tmp2[0]["magento_item_id"];
						$fileName = $tmp2[0]["magento_file_name"];
						
						$this->setMainImg($productId, $fileName);
					}
				}
				$c++;
			}
		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}
		
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Loeschvorgang: Artikelbilder  - beendet ::");
		echo "\n";
	}
	
	private function removeImageFromMagento($magento_image_name, $magento_item_id){
		$result = self::$magentoClient->call(self::$magentoSession, 'catalog_product_attribute_media.remove', array('product' => $magento_item_id, 'file' => $magento_image_name));
		return $result;
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
	
	private function setMainImg($productId, $fileName){
		$result = self::$magentoClient->call(
				self::$magentoSession,
				'catalog_product_attribute_media.update',
				array(
						$productId,
						$fileName,
						array('types' => array (
									'thumbnail',
									'small_image',
									'image'
						))
				)
		);
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
	
	private function getImagesByItem($magento_item_id){
		$query = 'SELECT * FROM `plenty_magento_images_mapping`'.DBUtils::buildWhere( array( 'magento_item_id' => $magento_item_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result;
	}
	
	private function removeImageFromDB($plenty_image_id){
		$query = 'DELETE FROM `plenty_magento_images_mapping`'.DBUtils::buildWhere( array( 'plenty_image_id' => $plenty_image_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->delete($query);
	}
	
	private function getMagentoImageIDs(){
		$query = 'SELECT `plenty_image_id` FROM `plenty_magento_images_mapping`';
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result;
	}
	
	private function getMagentoImageData($plenty_image_id){
		$query = 'SELECT `magento_item_id`, `magento_file_name` FROM `plenty_magento_images_mapping`'.DBUtils::buildWhere( array( 'plenty_image_id' => $plenty_image_id));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result;
	}
}

?>