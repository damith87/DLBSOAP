<?php

#888888888888888888888888888888888888888888888888888888888888888888888888888888888888888#
#																						#
#	Script Description: SOAP Web Service for Development Lottries Board of Sri Lanka	#
#	================================================================================	#
#																						#
#	File Version	:	Version 1.0 Beta												#
#	Author			: 	Damith Rushika Kothalawala										#
#	Created	Date	:	14th July 2012													#
#	Last Modified	:	17th July 2012													#
#																						#
#########################################################################################

require_once("lib/nusoap.php");
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('LK_GOV_DLB_SOAP', 'urn:LK_GOV_DLB_SOAP');
// Register the method to expose
$server->register('GetResults',           		// method name
    array('LotteryId' => 'xsd:string',   		// input LotteryId
         	'LotteryDate' => 'xsd:int', 		// input LotteryDate
    		'LotteryDraw' => 'xsd:int', 	  	// input LotteryDraw
    		'ApiAuthKey' => 'xsd:string'),  	// input Api Auth Key
    array('Results' => 'xsd:string'),     		// output Lottery Results
    'urn:LK_GOV_DLB_SOAP',                		// namespace
    'urn:LK_GOV_DLB_SOAP#GetResults',     		// soapaction
    'rpc',                                		// style
    'encoded',                            		// use
    'SOAP API Service for Lottery Results'  	// documentation
);
// Define the method as a PHP function
function GetResults($LotteryId,$LotteryDate,$LotteryDraw,$ApiAuthKey) {
	       require("DlbResultProcessor.php");
		   return GetResultsFromDb($LotteryId,$LotteryDate,$LotteryDraw,$ApiAuthKey);

}
$server->error_str="error";
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
