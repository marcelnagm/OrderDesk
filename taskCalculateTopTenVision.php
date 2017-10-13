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

require_once __DIR__ . '/src/TopTen.php';
require_once __DIR__ . '/src/OrderItem.php';
require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/src/Shipping.php';
require_once __DIR__ . '/src/Currency.php';
require_once __DIR__ . '/src/CustomerOrders.php';
require_once __DIR__ . '/src/MyETHPrices.php';
require_once __DIR__ . '/src/mybtcprices.php';
require_once __DIR__ . '/src/openqcxorders.php';
require_once __DIR__ . '/src/OrderRepository.php';
require_once __DIR__ . '/vendor/CalculatorAVG.php';

//// the connection configuration
require 'config.inc';
// 
//
//
//start the connection with db.
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);


$entityManager->getConnection()->exec("update customerorders set CurrentDate ='" . gmdate('Y-m-d', time()) . "' ");



//here we search where have differnt quantity on ordersItem and customer order, and update.
$list = $entityManager->getConnection()->fetchAll("select oi.order_id,oi.quantity from customerorders cu, orderitem oi where cu.order_id = oi.order_id and cu.quantity <> oi.quantity");
foreach ($list as $row) {
    $sql = 'update customerorders set quantity =' . $row['quantity'] . ' where order_id = ' . $row['order_id'] . ' ;';
    $entityManager->getConnection()->exec($sql);
}

//get all customer orders where traded flag = 1
$dql = $entityManager->createQueryBuilder();
$query = $dql->select('cu')->from('\src\CustomerOrders', 'cu')
        ->Where('cu.Traded = 1');


$users = $query->getQuery()->getResult(); // arr
$customOrder = new src\CustomerOrders();
//var_dump($users);

foreach ($users as $customOrder) {
//    call the method to calculate every value
    $customOrder = CalculatorAVG::updateBtcAndEth($entityManager, $customOrder);
//  sae the instance on the app
    $entityManager->persist($customOrder);
}
//send to the db
$entityManager->flush();
