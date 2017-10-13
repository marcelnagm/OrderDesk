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
//require_once __DIR__ . '/src/qcxTransactions.php';
require_once __DIR__ . '/src/qcxtransactions.php';


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
$sort      = 'desc';
$limit     = 10;
$book		= 'btc_cad'; //specify the currency
$secret    = '99c933d1cedd7799b88215e9f201b3ad'; // My secret
$signature = hash_hmac('sha256', $nonce . $client . $key, $secret); // Hashing it

$data = array(
    'key'       => $key,
    'nonce'     => $nonce,
    'signature' => $signature,
    'sort'    => $sort,
    'limit'   => $limit,
    'book'     => $book
);

$data_string = json_encode($data);
$ch = curl_init('https://api.quadrigacx.com/v2/user_transactions');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);
echo ($result);



$nonce     = time(); // Unix timestamp
$key       = 'hmNgRNnDNC'; // My API Key
$client    = 47301; // My Client ID
$sort      = 'desc';
$limit     = 10;
$book		= 'eth_cad'; //specify the currency
$secret    = '99c933d1cedd7799b88215e9f201b3ad'; // My secret
$signature = hash_hmac('sha256', $nonce . $client . $key, $secret); // Hashing it

$data = array(
    'key'       => $key,
    'nonce'     => $nonce,
    'signature' => $signature,
    'sort'    => $sort,
 'limit'   => $limit,
    'book'     => $book
);

$data_string = json_encode($data);
$ch = curl_init('https://api.quadrigacx.com/v2/user_transactions');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);
echo ($result);
?>