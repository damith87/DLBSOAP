<?php

require_once("lib/nusoap.php");
require_once("rpros.php");

$server = new soap_server();

// Initialize WSDL support
$server->configureWSDL('lk_gov_dlb_soap', 'urn:lk_gov_dlb_soap');

// Register the method to expose
$server->register('getResultsBDN',          	// method name
    array('lottertyId' => 'xsd:string',   		// input LotteryId
    		'drawNumber' => 'xsd:int', 	  		// input LotteryDraw
    		'apiAuthKEY' => 'xsd:string'),  	// input Api Auth Key
    array('Results' => 'xsd:string'),     		// output Lottery Results
    'urn:lk_gov_dlb_soap',                		// namespace
    'urn:lk_gov_dlb_soap#getResultsBDN',     	// soapaction
    'rpc',                                		// style
    'encoded',                            		// use
    'Get Lottery Results by Lottery ID and Draw Number'  	// documentation
);
	
$server->register('getResultsLT',           // method name
    array('lottertyId' => 'xsd:string',   		// input LotteryId
   		  'apiAuthKEY' => 'xsd:string'),  		// input Api Auth Key
    array('Results' => 'xsd:string'),     		// output Lottery Results
    'urn:lk_gov_dlb_soap',                		// namespace
    'urn:lk_gov_dlb_soap#getResultsLT',     		// soapaction
    'rpc',                                		// style
    'encoded',                            		// use
    'Get Latest Lottery Results by Lottery ID'  	// documentation
);
	
$server->register('getResultsBD',           	// method name
    array('lottertyId' => 'xsd:string',   		// input LotteryId
         	'lotteryDate' => 'xsd:int', 		// input LotteryDate
    		'apiAuthKEY' => 'xsd:string'),  	// input Api Auth Key
    array('Results' => 'xsd:string'),     		// output Lottery Results
    'urn:lk_gov_dlb_soap',                		// namespace
    'urn:lk_gov_dlb_soap#getResultsBD',     		// soapaction
    'rpc',                                		// style
    'encoded',                            		// use
    'Get Lottery Results by Lottery ID and Draw Date'  	// documentation
);

$server->error_str="error";

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);


	
 function getResultsBDN($lottertyId,$drawNumber,$apiAuthKEY) // Get results by draw number
	{
		//if (apiAuthKEY($apiAuthKEY))
		return rpros($lottertyId,"",$drawNumber);
		//else 
		//return "Could Not Process x0010"; // API AUTH ERROR
	}
	
 function getResultsLT($lottertyId,$apiAuthKEY) // Get latest result
	{
		//if (apiAuthKEY($apiAuthKEY))
		return rpros($lottertyId,"","");
		//else
		//return "Could Not Process x0010"; // API AUTH ERROR	}
	}

	
 function getResultsBD($lottertyId,$lotteryDate,$apiAuthKEY) // Get results by date
	{
		//if (apiAuthKEY($apiAuthKEY))
		return rpros($lottertyId,$lotteryDate,"");
		//else
		//return "Could Not Process x0010"; // API AUTH ERROR
	}

function apiAuthKEY($apiAuthKEY)
	{
		return ;
	}

	