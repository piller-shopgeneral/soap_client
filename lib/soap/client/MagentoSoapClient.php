<?php

require_once ROOT.'lib/log/Logger.class.php';
require_once ROOT.'config/magento_soap.inc.php';


/**
 *
 * @author jpi
 * @copyright jpi
 */
class MagentoSoapClient
{
	/**
	 * singleton instance
	 *
	 * @var MagentoSoapClient
	 */
	private static $instance = null;
	private static $session = null;
	private static $client = null;


	private function __construct()
	{
		
	}

	/**
	 * singleton pattern
	 *
	 * @return MagentoSoapClient
	 */
	public static function getInstance()
	{
		if( !isset(self::$instance) || !(self::$instance instanceof MagentoSoapClient) )
		{
			self::$instance = new MagentoSoapClient();
		}

		return self::$instance;
	}

	/**
	 *
	 * @return Logger
	 */
	private function getLogger()
	{
		return Logger::instance(__CLASS__);
	}

	
	public function doAuthentification(){
		self::$client = new SoapClient(MAGENTO_WSDL_URL);
		
		try
		{
			$this->getLogger()->info(__FUNCTION__.': starting Magento Client ');
			self::$session = self::$client->login(MAGENTO_SOAP_USER, MAGENTO_SOAP_PASSWORD);
		}	
			catch(Exception $e)
		{
			$this->getLogger()->crit(__FUNCTION__.': exception getting token: '.$e->getMessage() );
			throw $e;
		}

		$this->getLogger()->info(__FUNCTION__.': received token: '.self::$session );
	}


	public function getSession(){
		return self::$session;
	}
	
	public function getSoapClient(){
		return self::$client;
	}

	public function updateToken()
	{
		$this->doAuthentification();
	}
	
	public function endSession(){
		self::$client->endSession(self::$session);
	}
}

?>