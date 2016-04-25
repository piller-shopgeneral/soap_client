<?php

require_once ROOT.'lib/soap/call/PlentySoapCall.abstract.php';
require_once ROOT.'lib/soap/client/MagentoSoapClient.php';

class SoapCall_UpdateOrderStatus extends PlentySoapCall {
	
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
		if (! isset ( self::$instance ) || ! (self::$instance instanceof SoapCall_UpdateOrderStatus)) {
			self::$instance = new SoapCall_UpdateOrderStatus();
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
						$this->addPayment($magento_orders[$i], $amount, $plenty_order_id);
						
					}else if($order_status == "closed"){
						$status = 5;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "canceled"){
						$status = 6;
						$this->setOrderStatus($magento_orders[$i]["increment_id"], $status);
					}else if($order_status == "holded"){
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
	
	private function addPayment($magento_order, $amount, $plenty_order_id){
		$payment_method = $magento_order["payment"]["method"];
		$payment_trans_id = $magento_order["payment"]["last_trans_id"];
		$oArrayOfPlentysoapobject_addincomingpayments = new ArrayOfPlentysoapobject_addincomingpayments();
		$oArrayOfPlentysoapobject_addincomingpayments->item->Amount = $amount;
		$oArrayOfPlentysoapobject_addincomingpayments->item->ReasonForPayment = $payment_method.":".$payment_trans_id;
		$oArrayOfPlentysoapobject_addincomingpayments->item->TransactionID = $payment_trans_id;
		$oArrayOfPlentysoapobject_addincomingpayments->item->CustomerID = $plenty_customer_id;
		$oArrayOfPlentysoapobject_addincomingpayments->item->Currency = "Euro";
		$oArrayOfPlentysoapobject_addincomingpayments->item->MethodOfPaymentID = 0;
		
		$oPlentySoapRequest_AddIncomingPayments = new PlentySoapRequest_AddIncomingPayments();
		$oPlentySoapRequest_AddIncomingPayments->IncomingPayments = $oArrayOfPlentysoapobject_addincomingpayments;
		
		$this->getPlentySoap()->AddIncomingPayments($oPlentySoapRequest_AddIncomingPayments);
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