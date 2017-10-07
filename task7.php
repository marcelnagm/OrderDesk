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


$url_contries = array(
    'CA' => 'CAD',
    'US' => 'USD'
);

//----
foreach ($url_contries as $contry => $value) {
    $list = $entityManager->getConnection()->fetchAll('select order_id from shipping where country="'.$contry.'"');
    $order_id = array();
    foreach ($list as $row) {
        $order_id[] = $row["order_id"];
    }
////    
    $dql = $entityManager->createQueryBuilder();
    $query = $dql->select('cu')->from('\src\CustomerOrders', 'cu')
                    ->add('where', $dql->expr()->in('cu.order_id', $order_id))
                    ->andWhere('cu.Traded = 1')->setMaxResults(2);
////
    $users = $query->getQuery()->getResult(); // arr
    $customOrder = new src\CustomerOrders();
    foreach ($users as $customOrder) {
        $customOrder = CalculatorAVG::updateBtcAndEth($entityManager, $customOrder,$value);
        $entityManager->persist($customOrder);
    }
}
$entityManager->flush();
