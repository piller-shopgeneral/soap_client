<?php

require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class MagentoItem {
	
	private $typeOfProduct = 'simple';#ProduktTyp
	private $sku = null;#ArtikelNr.
	private $name = null;#Name 1
	private $categories = null;
	private $description = null;#Artikeltext
	private $short_description = null;#Meta-Beschreibung
	private $weight = null;#Gewicht (Brutto)
	private $status = null; #Inaktiv
	private $url_key = null; #Inaktiv
	private $visibility = 4;#0= Einzeln nicht Sichtbare 1=Katalog 2= Suche 3=
	private $price = null; #Preis
	private $special_price = null; #Preis1
	private $tax_class_id = null; #0=keine 1=Vollbesteuert (19%) 2=Teilbesteuert (7%)
	private $meta_title = null;#Name 1
	private $meta_keyword = null;#Meta-Keywords
	private $meta_description = null;#Meta-Beschreibung

	public function __construct()
	{
		
	}
	
	public function getProductCreateEntityArray($type, $attributeSet){
		
		$catalogProductCreateEntityArray = null;
		
		$productData = 	array(
							'categories' => $this->categories,
							'websites' => array(1),
							'name' => $this->name,
							'description' => $this->description,
							'short_description' => $this->short_description,
							'weight' => $this->weight,
							'status' => $this->status,
							'url_key' => $this->url_key,
							'url_path' => 'url_path',
							'visibility' => $this->visibility,
							'price' => $this->price,
							'special_price' => $this->special_price,
							'tax_class_id' => $this->tax_class_id,
							'meta_title' => $this->name,
							'meta_keyword' => $this->meta_keyword,
							'meta_description' => $this->meta_description);
		
		if($type === "neu"){
			$catalogProductCreateEntityArray = array(
					$this->typeOfProduct, $attributeSet['set_id'], $this->sku, $productData);
		}
		
		if($type === "update"){
			$catalogProductCreateEntityArray = array(
					$this->sku, $productData);
			}
			
		return $catalogProductCreateEntityArray;
	}
	
	public function setSKU($plenty_sku){
		$this->sku = $plenty_sku;
	}
	
	public function setName($plenty_name){
		$this->name = $plenty_name;
	}
	
	public function setDescription($plenty_description){
		$this->description = $plenty_description;
	}
	
	public function setWeight($plenty_weight){
		$this->weight = $plenty_weight;
	}
	
	public function setShortDescription($plenty_short_description){
		$this->short_description = $plenty_short_description;
	}
	
	public function setStatus($plenty_status){
		$this->status = $plenty_status;
	}
	
	public function setUrlKey($url_key){
		$this->url_key = $url_key;
	}
	
	public function setPrice($plenty_price){
		$this->price = $plenty_price;
	}
	
	public function setSpecialPrice($plenty_special_price){
		$this->special_price = $plenty_special_price;
	}
	
	public function setTaxClassId($plenty_tax_class_id){
		$this->tax_class_id = $plenty_tax_class_id;
	}
	
	public function setMetaTitle($plenty_meta_title){
		$this->meta_title = $plenty_meta_title;
	}
	
	public function setMetaKeyword($plenty_meta_keyword){
		$this->meta_keyword = $plenty_meta_keyword;
	}
	
	public function setMetaDescription($plenty_meta_description){
		$this->meta_description = $plenty_meta_description;
	}
	
	public function setCategory($magento_category_id){
		$this->categories = $magento_category_id;
	}
	
}