<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

/**
 * Save all country of delivery names to local datatable.
 *
 * @author phileon
 * @copyright plentymarkets GmbH www.plentymarkets.com
 */
class Adapter_UpdateOrderStatus extends PlentySoapCall 
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
			$this->getLogger()->info(":: Starte Update: Bestellstatus (processing)");
			$this->lastUpdateFrom = $this->checkLastUpdate();
			$this->lastUpdateTo = time();
			
			$magento_orders = $this->getMagentoOrders();
			
			$i = 0;
			while($i < count($magento_orders)){
				if(strtotime($magento_orders[$i]["updated_at"]) > $this->lastUpdateFrom){
					
					$order_status = $magento_orders[$i]["status"];
					if($order_status == "pending"){
						$status = 1;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "processing"){
						$status = 3;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "complete"){
						$status = 4;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "closed"){
						$status = 5;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "canceled"){
						$status = 6;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "on hold"){
						$status = 7;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}
					$this->getLogger()->info(":: Status Update: Bestellung(".$magento_orders[$i]["increment_id"].") Status = ".$magento_orders[$i]["status"]);
				}
				$i++;
			}
		} catch(Exception $e)
		{
			$this->onExceptionAction ( $e );
		}

		$this->setLastUpdate($this->lastUpdateTo);
		self::$magentoClient->endSession(self::$magentoSession);
		$this->getLogger()->info(":: Update: Bestellstatus (processing)  - beendet ::");
		$this->getLogger()->info("\n");
	}
	
	public function setOrderStatus($magento_increment_number, $status){
		$oPlentySoapObject_SetOrderStatus = new PlentySoapObject_SetOrderStatus();
		$oPlentySoapObject_SetOrderStatus->ExternalOrderID = $magento_increment_number;
		$oPlentySoapObject_SetOrderStatus->OrderStatus = $status;
		
		$oArrayOfPlentysoapobject_setorderstatus = new ArrayOfPlentysoapobject_setorderstatus();
		$oArrayOfPlentysoapobject_setorderstatus->item = $oPlentySoapObject_SetOrderStatus;
		
		$PlentySoapRequest_SetOrderStatus = new PlentySoapRequest_SetOrderStatus();
		$PlentySoapRequest_SetOrderStatus->OrderStatus = $oArrayOfPlentysoapobject_setorderstatus;
		
		$this->getPlentySoap()->SetOrderStatus($PlentySoapRequest_SetOrderStatus);
	}
	
	private function getMagentoOrders(){
		$result = self::$magentoClient->call(self::$magentoSession, 'order.list');
		return $result;
	}
	
	private function checkLastUpdate(){
		$query = 'SELECT `last_update` FROM `plenty_last_status_update`'.DBUtils::buildWhere( array( 'id' => 1));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		$result = DBQuery::getInstance()->select($query, 'DBQueryResult');
		return $result->fetchAssoc()["last_update"];
	}
	
	private function setLastUpdate($lastUpdateTill){
		$query = 'REPLACE INTO `plenty_last_status_update` '.DBUtils::buildInsert(	array(	'id' => 1, 'last_update'	=>	$this->lastUpdateTo));
		$this->getLogger()->debug(__FUNCTION__.' '.$query);
		DBQuery::getInstance()->replace($query);
	}
}

?>