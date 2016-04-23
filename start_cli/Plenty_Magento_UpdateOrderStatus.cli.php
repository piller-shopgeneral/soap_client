<?php

/*
 * usage:
 * 
 * shell> php cli/PlentymarketsSoapExampleLoader.cli.php [ExampleName]
 * shell> php cli/PlentymarketsSoapExampleLoader.cli.php GetServerTime
 * 
 * If you want to see log output, than run this before:
 * shell> tail -f log/soap.log &
 * 
 */

require_once realpath(dirname(__FILE__).'/../').'/config/basic.inc.php';
require_once ROOT.'examples/UpdateOrderStatus/SoapCall_UpdateOrderStatus.class.php';

SoapCall_UpdateOrderStatus::getInstance()->execute();

?>