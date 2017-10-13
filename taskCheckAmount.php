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



//---- get all order_id wiht EST001
$list = $entityManager->getConnection()->fetchAll("select order_id from orderitem where code='EST001'");
if (count($list) > 0) {
    $order_id = array();
//    create an array with the list of the orderid
    foreach ($list as $row) {
        $order_id[] = $row["order_id"];
    }

    $dql = $entityManager->createQueryBuilder();
//search at the customersorders order_id in the list and traded =0 and CheckAmountAvailable  = 0
    $query = $dql->select('cu')->from('\src\CustomerOrders', 'cu')
            ->add('where', $dql->expr()->in('cu.order_id', $order_id))
            ->andWhere('cu.Traded = 0')
            ->andWhere('cu.CheckAmountAvailable  = 0');

    $users = $query->getQuery()->getResult(); // arr
//    $customOrder = new src\CustomerOrders();

//    get all resukt and
    foreach ($users as $customOrder) {

//        get the last qcxtranscations/
        $qcxtransactions  = $entityManager->getRepository('\src\qcxtransactions')->findBy(
                array(), array('id' => 'DESC'), 1);
        $qcxtransactions  = $qcxtransactions [0];
//aply the calculate
        $customOrder->setCheckAmountAvailable($customOrder->getBTCValue()+$qcxtransactions->getBtc_available());
//        sabe on the orm layer
        $entityManager->persist($customOrder);
    }
}
//save on the db
$entityManager->flush();
