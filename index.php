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
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
//$entityManager = EntityManager::create($dbParams, $config);
////echo $entityManager->isOpen();
////if($entityManager->isOpen()){
//    $order = new src\Order();
//    $order->setSource_id(11111111);
//    $order->setSource_name('teste');
//    $order->setSource_id2(11111112);
//    $order->setEmail('teste@t.cm');
//    $order->setQuantity_total(2.344);
//    $order->setProduct_total(23.44);
//    $order->setShipping_total(1.3);
//    $order->setDiscount_total(0.22);
//    $order->setOrder_total(922322);
//    $order->setCc_number('3xxx33 3333 4433');
//    $order->setCc_exp('06/2020');
//    $order->setPayment_type('Visa, Always Visa');
//    $order->setPayment_method('CC');
//    $order->setPayment_status('worked');
//    $order->setCustomer_id(432242);
//    $order->setEmail_count(9);
//    $order->setIp_address('200.129.189.253');
//    $order->setFulfillment_name('testo testa');
//    $order->setFulfillment_id(4);
//    $order->setDate_added('2/2/2017');
//    $order->setDate_updated('2/2/2017');
//    $order->setCheckout_data('testing data1');
//    $order->setOrder_metadata('testing data2');
//    $order->setShipping('testing data3');
//    $order->setCustomer('testing data4');
//    $order->setCustomer_array('testing data4');
//    $order->setReturn_address('testing data5');
//    $order->setDiscount_list('testing data6');
//    $order->setOrder_notes('testing data7');
//    $order->setOrder_shipments('testing data8');
////    
//////    $entityManager->beginTransaction();
//    $entityManager->persist($order);    
//    $entityManager->flush();
//
//$data = array(
//    'cost' => '45335',
//    'weight' => '45.15',
//    'tracking_number' => 'teste');
//$ship = new src\Shipments($data);
//$ship->setCarrier_code('dasdsadas');
//$ship->setCost('903.2');
//$ship->setWeight('903.2');
//$ship->setShipment_method('international');
//$ship->setStatus('Gogogo');
//$ship->setTracking_url('http://go.ggo.goo');
//    $entityManager->persist($ship);    
//    $entityManager->flush();
//    echo $ship->getId().' - ';
//    echo $order->getId();
//print_r($ship);

//echo $ship->getTracking_number();
$api = new vendor\OrderDeskApiClient('5012', 'IK7a17iQt9NpzzJ0bb7PNJaYZf2kL8J5LMo4ptrNFzuwRsH4pU');

$result = $api->get("test");
////echo "<pre>" . print_r($result, 1) . "</pre>";
if($result['status'] == 'success')
    echo 'Connected!';

// in folder use which folder you want to sincronize.
//based on id
// [30145] => New 
// [30146] => Prepared 
// [30147] => Closed 
// [30148] => Canceled 

$args = array(
  "folder_id" => "30145",
  "order_by" => "source_name",
);
//get orders via api
$result = $api->get("orders", $args);
echo "<pre>" . print_r($result, 1) . "</pre>";

echo 'Number of Orders' - $result['records_returned'];

//echo "<pre>" . print_r($result['orders']) . "</pre>";
echo "<pre>" . print_r($result['orders'][0]) . "</pre>";
//$order1 = new src\Order($result['orders'][0]);
$order1 = new src\Shipments($result['orders'][0]['shipping']);

echo "<pre>" . print_r($order1) . "</pre>";
//get info about store
//$result = $api->get("store");
//echo "<pre>" . print_r($result) . "</pre>";
