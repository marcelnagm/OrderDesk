<?php

require_once __DIR__ . '/vendor/autoload.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);



use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
// 
$paths = array("/model");
$isDevMode = true;
//
//require_once './src/Object.php';
require_once './src/Order.php';
require_once './src/Shipments.php';
require './vendor/OrderDeskApiClient.php';


//// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_sqlsrv',
    'user'     => 'sa',
    'password' => '#Alessandr4',
    'dbname'   => 'OrderDesk',
    'host'     => 'localhost',
    'port'     => '1433',
);
// 
//
//

$api = new vendor\OrderDeskApiClient('5012', 'IK7a17iQt9NpzzJ0bb7PNJaYZf2kL8J5LMo4ptrNFzuwRsH4pU');

$result = $api->get("test");
echo "<pre>" . print_r($result, 1) . "</pre>";
if ($result['status'] == 'success') {
    $conn = true;
    echo 'Connected!<br>';
}

// in folder use which folder you want to sincronize.
//based on id
// [30145] => New 
// [30146] => Prepared 
// [30147] => Closed 
// [30148] => Canceled 

//if get connection estabilished retrive data
if ($conn) {
    $args = array(
        "folder_id" => "30145",
        "order_by" => "source_name",
    );
//get orders via api
    $result = $api->get("orders", $args);
    $records = $result['records_returned'];
    echo 'Number of Orders -'.$records,'<br>';
    
//start the connection with db.
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
    $entityManager = EntityManager::create($dbParams, $config);
    $entityManager->beginTransaction();

//echo "<pre>" . print_r($result['orders']) . "</pre>";
    for ($i = 0; $i < $records; $i++) {
        $ship = new src\Shipments($result['orders'][$i]['shipping']);
//        echo "<pre>" . print_r($ship) . "</pre>";
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
        $data_order['id_order'] = $data_order['id'];
        $order = new src\Order($data_order);

		
		$query = $entityManager->createQuery('SELECT count(u.order_id) FROM src\Order u WHERE order_id = '.$data_order['id_order']);
		$count = $query->getSingleScalarResult();
		if($count ==0){
//        echo "<pre>" . print_r($order) . "</pre>";
//        echo "<pre>" . print_r($data_order) . "</pre>";

//        persist the data on db
         $entityManager->persist($ship);
       $entityManager->flush();
       echo $ship->getId().' -';
        $order->setShipping_id($ship->getId());
        $entityManager->persist($order);
        $entityManager->flush();
        echo $order->getId().' <br>';
		}
    }

//    
//    commit and flush all data to db.
        $entityManager->commit();
        $entityManager->flush();
}
