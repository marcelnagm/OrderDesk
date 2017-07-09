<?php

require_once __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);



//use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\EntityManager;
// 
//$paths = array("/model");
//$isDevMode = true;
//
require_once './src/Object.php';
require_once './src/Order.php';
require_once './src/Shipments.php';
require './vendor/OrderDeskApiClient.php';


//// the connection configuration
//$dbParams = array(
//    'driver'   => 'pdo_sqlsrv',
//    'user'     => 'testando',
//    'password' => '#Alessandr4',
//    'dbname'   => 'OrderDesk',
//    'host'     => '52.242.37.158',
//    'port'     => '1433',
//);
// 
//
//

$api = new vendor\OrderDeskApiClient('5012', 'IK7a17iQt9NpzzJ0bb7PNJaYZf2kL8J5LMo4ptrNFzuwRsH4pU');

$result = $api->get("test");
////echo "<pre>" . print_r($result, 1) . "</pre>";
if ($result['status'] == 'success'){
    $conn = true;    
    echo 'Connected!';
}

// in folder use which folder you want to sincronize.
//based on id
// [30145] => New 
// [30146] => Prepared 
// [30147] => Closed 
// [30148] => Canceled 
if($conn){
$args = array(
    "folder_id" => "30145",
    "order_by" => "source_name",
);
//get orders via api
$result = $api->get("orders", $args);
//echo "<pre>" . print_r($result, 1) . "</pre>";
$records = $result['records_returned'];
echo 'Number of Orders' - $records;

//echo "<pre>" . print_r($result['orders']) . "</pre>";
echo "<pre>" . print_r($result['orders'][0]['shipping']) . "</pre>";
for ($int = 0; $i < $records; $i++) {
    $ship = new src\Shipments($result['orders'][$i]['shipping']);
    echo "<pre>" . print_r($ship) . "</pre>";
    $data_order = $result['orders'][$i];
    unset($data_order['customer']);
    unset($data_order['return_address']);
    unset($data_order['checkout_data']);
    unset($data_order['order_metadata']);
    unset($data_order['order_metadata']);
    unset($data_order['discount_list']);
    unset($data_order['order_notes']);
    unset($data_order['order_items']);
    unset($data_order['order_shipments']);
    unset($data_order['shipping']);
    $order = new src\Order($data_order);

    echo "<pre>" . print_r($order) . "</pre>";
    echo "<pre>" . print_r($data_order) . "</pre>";
}

//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
//$entityManager = EntityManager::create($dbParams, $config);
//////    $entityManager->beginTransaction();
//    $entityManager->persist($order);    
//    $entityManager->flush();

}
