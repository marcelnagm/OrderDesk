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
require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/src/OrderItem.php';
require_once __DIR__ . '/src/OrderRepository.php';
require_once __DIR__ . '/src/Shipping.php';
require_once __DIR__ . '/src/Shipment.php';
require __DIR__ . '/vendor/OrderDeskApiClient.php';


//// the connection configuration
 
require 'config.inc';
// 
//
//

$api = new vendor\OrderDeskApiClient('5012', 'UHE52DCwbpRFhTQJSiVgrjo4yD3KcTGb0Dxja7NLYBJl5sf0Jo', 'application/json');
$result = $api->get("test");

//echo "<pre>" . print_r($result, 1) . "</pre>";
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
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
    $entityManager = EntityManager::create($dbParams, $config);
    $entityManager->beginTransaction();
    $orders = $result['orders'];
var_dump($orders);
//echo "<pre>" . print_r($orders) . "</pre>";
    for ($i = 0; $i < $records; $i++) {
        $data_ship = $orders[$i]['shipping'];
        $data_ship['sstate'] = $data_ship['state'];
        $ship = new src\Shipping($data_ship);
//        echo "<pre>" . print_r($ship) . "</pre>";
        $data_order = $orders[$i];
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



        $num_records = $entityManager->getRepository('src\Order')->findBy(array('order_id' => $data_order['id_order']));



        $count = count($num_records);

        if ($count == 0) {
            //            echo "<pre>" . print_r($order) . "</pre>";
            //                       echo "<pre>" . print_r($data_order) . "</pre>";
//        persist the data on db
            $entityManager->persist($ship);
            $entityManager->flush();
            //             echo $ship->getId() . ' -';
            $order->setShipping_id($ship->getId());
            $entityManager->persist($order);
            $entityManager->flush();
            //             echo $order->getId() . ' <br>';

            $orderItems = $orders[$i]['order_items'];
            for ($j = 0; $j < count($orderItems); $j++) {
                $data_orderItem = $orderItems[$j];
                $data_orderItem['order_id'] = $data_order['id'];                
                $data_orderItem['item_id'] = $data_orderItem['id'];;
                $item = new src\OrderItem($data_orderItem);
                echo "<pre>" . print_r($item) . "</pre>";	
                $entityManager->persist($item);
                $entityManager->flush();
            }
        }
        $result = $api->get("orders/" . $data_order['id_order'] . "/shipments");
        //            echo "orders/" . $data_order['id_order'] . "/shipments<br>";
//        echo "<pre>" . print_r($result['shipments']) . "</pre>";
        $data_shipments = $result['shipments'];


        for ($j = 0; $j < count($data_shipments); $j++) {

            unset($data_shipments[$j]['label_format']);
            unset($data_shipments[$j]['label_image']);
            unset($data_shipments[$j]['print_status']);
            unset($data_shipments[$j]['order_items']);
            unset($data_shipments[$j]['cart_shipment_id']);
            unset($data_shipments[$j]['label_shipment_id']);

            $num_records = $entityManager->getRepository('src\Shipment')->findBy(array('shipment_id' => $data_shipments[$j]['id']));



            $count = count($num_records);

            if ($count == 0) {
                echo "<pre>" . print_r($data_shipments[$j]) . "</pre>";
                $shipment = new src\Shipment($data_shipments[$j]);
                echo "<pre>" . print_r($shipment) . "</pre>";
                $entityManager->persist($shipment);
            }
            $entityManager->flush();
        }
    }

//    
//    commit and flush all data to db.
    $entityManager->commit();
    $entityManager->flush();
}
