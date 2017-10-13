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

//retrive the list by the code SEA001 and externalorderid = empty string
$list = $entityManager->getRepository('\src\CustomerOrders')->findBy(array('code' => 'SEA001', 'ExternalOrderID' => ''));

//get the last btc
$btc = $entityManager->getRepository('\src\mybtcprices')->findBy(
        array(), array('id' => 'DESC'), 1);
$btc = $btc[0];
//get the last eth
$eth = $entityManager->getRepository('\src\myethprices')->findBy(
        array(), array('id' => 'DESC'), 1);
$eth = $eth[0];



//----
$customOrder = new src\CustomerOrders;
echo 'How many orders i get - ' . count($list);
foreach ($list as $customOrder) {
    $nonce = time(); // Unix timestamp
    $key = 'hmNgRNnDNC'; // My API Key
    $client = 47301; // My Client ID
//    set up the values that he get from customer order
    $amount = $customOrder->getBTCValue();
//    set ip the value that he get from btc
    $price = $btc->getAsk();
    $book = 'btc_cad'; //specify the currency
    $secret = '99c933d1cedd7799b88215e9f201b3ad'; // My secret
    $signature = hash_hmac('sha256', $nonce . $client . $key, $secret); // Hashing it

    $data = array(
        'key' => $key,
        'nonce' => $nonce,
        'signature' => $signature,
        'amount' => $amount,
        'price' => $price,
        'book' => $book,
    );

//    var_dump($data);
    $data_string = json_encode($data);
    $ch = curl_init('https://api.quadrigacx.com/v2/buy');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
//    send the request
    echo ($result);
//    decode the answer
    $result = json_decode($result, true);

//these are flags if he get a right answer and if the answer exist
    if (isset($result['id']) && $result != NULL) {
        $customOrder->setExternalOrderID($result['id']);
        $entityManager->persist($customOrder);
        $entityManager->flush();
    } else {
        echo 'Error ocourred with -' . $customOrder->getOrder_id() . ' --';
    }




    $nonce = time(); // Unix timestamp
    $key = 'hmNgRNnDNC'; // My API Key
    $client = 47301; // My Client ID
    //    set up the values that he get from customer order
    $amount = $customOrder->getETHValue();
    //    set ip the value that he get from eth
    $price = $eth->getAsk();
    $book = 'eth_cad'; //specify the currency
    $secret = '99c933d1cedd7799b88215e9f201b3ad'; // My secret
    $signature = hash_hmac('sha256', $nonce . $client . $key, $secret); // Hashing it

    $data = array(
        'key' => $key,
        'nonce' => $nonce,
        'signature' => $signature,
        'amount' => $amount,
        'price' => $price,
        'book' => $book
    );

    $data_string = json_encode($data);
    $ch = curl_init('https://api.quadrigacx.com/v2/buy');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
    echo ($result);
    $result = json_decode($result, true);


}
?>