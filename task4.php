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

$list = $entityManager->getRepository('\src\OrderItem')->findBy(array('code' => 'EXP001'));
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
            $timestamp = strtotime($order->getDate_added());

            echo $order->getDate_updated() . '-' . $timestamp;
            $dql = $entityManager->createQueryBuilder();
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.timestamp <= ' . $timestamp)
                            ->orderBy('btc.timestamp', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
            echo 'count--' . count($result).'==== ';
            var_dump($result);
            $mybtcprice = $result[0];


            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());
            
            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());
            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());
            $customOrder->setCode($orderItem->getCode());


            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';

            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() / 5;
            echo $price;
            $customOrder->setPrice_btc($price);
            unset($dql);

            $utc = gmdate('Y-m-d  G:i:s', $timestamp);
            echo '==== utc = ' . $utc;
            $query = $entityManager->createQuery('SELECT u FROM src\TopTen u WHERE '
                            . 'u.last_updated<=\'' . $utc . '\''
                            . 'order by u.last_updated DESC,u.rank asc'
                            . ' ')->setMaxResults(5);
            $top5 = $query->execute();

//        $top5 = $entityManager->createQuery('SELECT * FROM src\TopTen WHERE `last_updated` <= '
//                . ''.$utc.' ORDER by last_updated desc,rank asc limit 5')->execute();
//        
////        $top5 = $query->getResult();
            var_dump($top5);
            $customOrder->setTop1($price / $top5[0]->getPrice_btc());
            $customOrder->setTop2($price / $top5[1]->getPrice_btc());
            $customOrder->setTop3($price / $top5[2]->getPrice_btc());
            $customOrder->setTop4($price / $top5[3]->getPrice_btc());
            $customOrder->setTop5($price / $top5[4]->getPrice_btc());
            $entityManager->persist($customOrder);
            $entityManager->flush();
        }
    }
}