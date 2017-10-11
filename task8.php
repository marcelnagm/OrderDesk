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
require_once __DIR__ . '/src/qcxtransactions.php';
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



//----
$list = $entityManager->getConnection()->fetchAll("select order_id from orderitem where code='EST001'");
if (count($list) > 0) {
    $order_id = array();
    foreach ($list as $row) {
        $order_id[] = $row["order_id"];
    }
////    
    $dql = $entityManager->createQueryBuilder();
    $query = $dql->select('cu')->from('\src\CustomerOrders', 'cu')
            ->add('where', $dql->expr()->in('cu.order_id', $order_id))
            ->andWhere('cu.Traded = 0')
            ->andWhere('cu.CheckAmountAvailable  = 0');
////
//    var_dump($order_id);
    $users = $query->getQuery()->getResult(); // arr
    $customOrder = new src\CustomerOrders();
//        var_dump($users);
//    $qcxtransactions = new \src\qcxtransactions();
    foreach ($users as $customOrder) {

        $qcxtransactions  = $entityManager->getRepository('\src\qcxtransactions')->findBy(
                array(), array('id' => 'DESC'), 1);
        $qcxtransactions  = $qcxtransactions [0];
//        var_dump($qcxtransactions);
        $customOrder->setCheckAmountAvailable($customOrder->getBTCValue()+$qcxtransactions->getBtc_available());
        
        $entityManager->persist($customOrder);
    }
}

$entityManager->flush();