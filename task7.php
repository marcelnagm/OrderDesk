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


//$url_contries = array(
//    'CA' ,
//    'US' 
//);

//----
//foreach ($url_contries as $contry ) {
//    echo 'countr -- ' . $contry;
//    $list = $entityManager->getConnection()->fetchAll("select order_id from shipping where country='$contry'");
//    if (count($list) > 0) {
//        $order_id = array();
//        foreach ($list as $row) {
//            $order_id[] = $row["order_id"];
//        }
////    
  $list = $entityManager->getConnection()->fetchAll("select oi.order_id,oi.quantity from customerorders cu, orderitem oi where cu.order_id = oi.order_id and cu.quantity <> oi.quantity");
  foreach ($list as $row){
     $sql = 'update customerorders set quantity ='.$row['quantity'].' where order_id = '.$row['order_id'].' ;';
  $entityManager->getConnection()->exec($sql);
  }
  

        $dql = $entityManager->createQueryBuilder();
        $query = $dql->select('cu')->from('\src\CustomerOrders', 'cu')
//                        ->add('where', $dql->expr()->in('cu.order_id', $order_id))
                        ->Where('cu.Traded = 1');
//                        ->andWhere('cu.Traded = 1');
////
        $users = $query->getQuery()->getResult(); // arr
        $customOrder = new src\CustomerOrders();
        var_dump($users);
        foreach ($users as $customOrder) {
            $customOrder = CalculatorAVG::updateBtcAndEth($entityManager, $customOrder);
            $entityManager->persist($customOrder);
        }
//    }
//}
$entityManager->flush();
