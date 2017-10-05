<?php

require_once __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// 
$paths = array("/model");
$isDevMode = true;
//
//require_once __DIR__.'./src/Object.php';
require_once __DIR__ . '/src/OrderRepository.php';
require_once __DIR__ . '/src/TopTen.php';
require_once __DIR__ . '/src/OrderItem.php';
require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/src/Currency.php';
require_once __DIR__ . '/src/CustomerOrders.php';
require_once __DIR__ . '/src/MyETHPrices.php';
require_once __DIR__ . '/src/mybtcprices.php';
require_once __DIR__ . '/src/openqcxorders.php';


//// the connection configuration
require 'config.inc';
// 
//
//
//start the connection with db.
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

//----




$nonce     = time(); // Unix timestamp
$key       = 'hmNgRNnDNC'; // My API Key
$client    = 47301; // My Client ID
$book		= 'btc_cad'; //specify the currency
$secret    = '99c933d1cedd7799b88215e9f201b3ad'; // My secret
$signature = hash_hmac('sha256', $nonce . $client . $key, $secret); // Hashing it
$data = array(
    'key'       => $key,
    'nonce'     => $nonce,
    'signature' => $signature,
	'book' => 		$book	
);
$data_string = json_encode($data);
$ch = curl_init('https://api.quadrigacx.com/v2/open_orders');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);
 $result = json_decode($result, true);
 var_dump($result);
 $data = $result[0];
//var_dump($data);

$data['ID_Value'] =$data['id'] ;
$data['datetime_added'] =$data['datetime'] ;

$list = $entityManager->getRepository('\src\openqcxorders')->findBy(array('ID_Value' => $data['ID_Value']));
//var_dump($list);
echo 'NUmber ocourrences - ' . count($list);
if (count($list) == 0) {
$btc =  new src\openqcxorders($data); 

    $entityManager->persist($btc);
    
    $entityManager->flush();   
}//             
    curl_close($ch);
