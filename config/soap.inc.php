<?php


/* 
 * wsdl url
 * 
 * please enter your own wsdl url
 */
define('WSDL_URL', 'http://fittaste24.plentymarkets-x1.com/plenty/api/soap/version115/?xml');

/*
 * soap user name
 * 
 * please enter your own user
 */
define('SOAP_USER', 'Wadim');

/*
 * soap password
 * 
 * please enter your own password
 */
define('SOAP_PASSWORD', 'Plenty123456!');


/*
 * the following params are used from PlentymarketsSoapGenerator.class.php
 */

/*
 * class prefix
 */
define('SOAP_CLASS_PREFIX', '');

/*
 * output base dir
 */
define('SOAP_OUTPUT_BASE_DIR', ROOT.'lib/soap');

/*
 * sub dir name for models
 */
define('SOAP_MODEL_DIR', 'model');

/*
 * sub dir name for controller
*/
define('SOAP_CONTROLLER_DIR', 'controller');

/*
 * controller class name
 */
define('SOAP_CONTROLLER_CLASS_NAME', 'PlentySoap');

/*
 * autoloader for all soap model classes
*/
require_once ROOT.'lib/soap/autoloader/SoapModelLoader.fnc.php';

?>