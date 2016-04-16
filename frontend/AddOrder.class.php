<?php

require_once 'db.inc.php';

class AddOrder
{
	
	public static $db = null;
	private static $instance = null;
	
	public function __construct()
	{
		$this->init();
	}
	
	public static function getInstance() {
		if (! isset ( self::$instance ) || ! (self::$instance instanceof AddOrder)) {
			self::$instance = new AddOrder();
		}
		return self::$instance;
	}

    public static function init() {
    	self::$db = new mysqli(SQL_DATA_SOURCE, SQL_USERNAME, SQL_PASSWORD, SQL_DATA_BASE, SQL_PORT);
    	if ($mysqli->connect_errno){
    		#inTXT schreiben
    	}
    }
    
    public function addOrderToDatabase($order_id){
    	if(self::$db->query("INSERT INTO magento_orders(order_id) VALUES (".$order_id.")")  === TRUE){
    		printf("Added to DB.\n");
    	}
    }
}
?>