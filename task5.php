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


//// the connection configuration
require './config.inc';
// 
//
//
//start the connection with db.
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

//---------------------EST001-------------------

$list = $entityManager->getRepository('\src\OrderItem')->findBy(array('code' => 'EST001'));
//var_dump($list);
echo 'NUmber ocourrences - ' . count($list);
if (count($list) > 0) {

    $orderItem = new src\OrderItem;
    $order = new src\Order;
    foreach ($list as $orderItem) {
        $order = $entityManager->getRepository('\src\Order')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
        if (count($entityManager->getRepository('\src\CustomerOrders')->findBy(array('order_id' => $orderItem->getOrder_id()))) == 0) {
//        echo $orderItem->getOrder_id();
//        var_dump($order);
            $timestamp = $order->getDate_added();

            $dql = $entityManager->createQueryBuilder();
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
//            echo 'count--' . count($result).'==== ';
//            var_dump($result);
            $mybtcprice = $result[0];


            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());

            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDatePurchased($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());

            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());
            $customOrder->setCode($orderItem->getCode());


//            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
//            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
//            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';

            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock();
//            echo $price;
            $customOrder->setBTCValue($price);
            unset($dql);


            $entityManager->persist($customOrder);
            $entityManager->flush();
        }
    }
}

//---------------------SEA001-------------------

$list = $entityManager->getRepository('\src\OrderItem')->findBy(array('code' => 'SEA001'));
//var_dump($list);
echo 'NUmber ocourrences - ' . count($list);
if (count($list) > 0) {

    $orderItem = new src\OrderItem;
    $order = new src\Order;
    foreach ($list as $orderItem) {
        $order = $entityManager->getRepository('\src\Order')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
        if (count($entityManager->getRepository('\src\CustomerOrders')->findBy(array('order_id' => $orderItem->getOrder_id()))) == 0) {
//        echo $orderItem->getOrder_id();
//        var_dump($order);
            $timestamp = $order->getDate_added();

            $dql = $entityManager->createQueryBuilder();
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
//            echo 'count--' . count($result).'==== ';
//            var_dump($result);
            $mybtcprice = $result[0];


            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());

            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDatePurchased($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());

            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());
            $customOrder->setCode($orderItem->getCode());


//            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
//            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
//            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';

            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock();
//            echo $price;
            $customOrder->setBTCValue($price);
            unset($dql);
            unset($query);
            unset($result);
            
            $dql = $entityManager->createQueryBuilder();
            $query = $dql->select('btc')
                            ->from('\src\myethprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
//            echo 'count--' . count($result).'==== ';
//            var_dump($result);
            $mybtcprice = $result[0];
            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock();
//            echo $price;
            $customOrder->setETHValue($price);

            $entityManager->persist($customOrder);
            $entityManager->flush();
        }
    }
}

