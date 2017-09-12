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
require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/src/OrderItem.php';
require_once __DIR__ . '/src/Shipping.php';
require_once __DIR__ . '/src/Shipment.php';
require __DIR__ . '/vendor/OrderDeskApiClient.php';


//// the connection configuration
$dbParams = array(
    'driver' => 'pdo_sqlsrv',
    'user' => 'testando',
    'password' => '#Alessandr4',
    'dbname' => 'OrderDesk',
    'host' => 'localhost',
    'port' => '1433',
);
// 
//
//

$od = new vendor\OrderDeskApiClient(5012, 'IK7a17iQt9NpzzJ0bb7PNJaYZf2kL8J5LMo4ptrNFzuwRsH4pU');
$result = $od->get("test");
echo "<pre>" . print_r($result, 1) . "</pre>";


$api = new vendor\OrderDeskApiClient('5012', 'IK7a17iQt9NpzzJ0bb7PNJaYZf2kL8J5LMo4ptrNFzuwRsH4pU', 'application/json');

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
    echo 'Number of Orders -' . $records, '<br>';

//start the connection with db.
    
    $orders = $result['orders'];
	for ($i = 0; $i < $records; $i++) {
	$data_order = $orders[$i];
	echo "<pre>" . print_r($orders[$i]['order_items']) . "</pre>";
	$orderItems = $orders[$i]['order_items'];
	for($j=0;$j<count($orderItems);$j++)
		$data_orderItem = $orderItems[$j];
		$data_orderItem['order_id'] = $data_order['id'];
		unset($data_orderItem['id_order']);
		$data_orderItem['item_id'] = $data_orderItem['id'];
		$data_orderItem['metadata'] = serialize($data_orderItem['metadata'] );
		$item = new \src\OrderItem($data_orderItem);
		echo "<pre>" . print_r($item) . "</pre>";	
	
	}
}