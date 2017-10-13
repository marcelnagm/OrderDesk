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
require_once __DIR__ . '/src/Shipping.php';
require_once __DIR__ . '/src/Shipment.php';
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

//get all the orderitem by the code
$list = $entityManager->getRepository('\src\OrderItem')->findBy(array('code' => 'EST001'));
//var_dump($list);
echo 'NUmber ocourrences - ' . count($list);
if (count($list) > 0) {

    $orderItem = new src\OrderItem;
    $order = new src\Order;
    foreach ($list as $orderItem) {
//        get the full order information
        $order = $entityManager->getRepository('\src\Order')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//        check if its on the customer order, if not go on
        if (count($entityManager->getRepository('\src\CustomerOrders')->findBy(array('order_id' => $orderItem->getOrder_id()))) == 0) {
            echo $orderItem->getOrder_id();
//            get the timestamp
            $timestamp = $order->getDate_added();
//            echo $timestamp;
            $dql = $entityManager->createQueryBuilder();
//            search for the last btc on the date informed
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
            $mybtcprice = $result[0];
            
//            get the info about shipping
            $shipping = $entityManager->getRepository('\src\Shipping')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//        $shipment =new src\Shipment;
//            get the info about shipment
            $shipment = $entityManager->getRepository('\src\Shipment')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//             var_dump($shipment);
            
//            set up all the data
            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());
            $customOrder->setQuantity($orderItem->getQuantity());

            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDatePurchased($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());
            
//            calculate order total
            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());
            $customOrder->setCode($orderItem->getCode());
            $customOrder->setCountry($shipping->getCountry());
            $customOrder->setTrackingNumber($shipment->getTracking_number());
            $customOrder->setCurrentDate(null);

//            fetch sku data to the customer order
            $shull_data = $entityManager->getConnection()->fetchAll('select TITLE,SKUDescription from skus where SKU="' . $customOrder->getCode() . '"')[0];
//            var_dump($shull_data);
            $customOrder->setTitle($shull_data['TITLE']);
            $customOrder->setSKUDescription($shull_data['SKUDescription']);


//            echo '  / order_id  - ' . $orderItem->getOrder_id();
//            
//            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
//            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
//            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';
//            calcultate the price given by the formula
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
//    $order = new src\Order;
    foreach ($list as $orderItem) {
//        $order = new src\Order;
//           get the full order information
        $order = $entityManager->getRepository('\src\Order')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//           check if its on the customer order, if not go on
        if (count($entityManager->getRepository('\src\CustomerOrders')->findBy(array('order_id' => $orderItem->getOrder_id()))) == 0) {
//        echo $orderItem->getOrder_id();
//        var_dump($order);
            $timestamp = $order->getDate_added();

            $dql = $entityManager->createQueryBuilder();
//                search for the last btc on the date informed
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
//            echo 'count--' . count($result).'==== ';
//            var_dump($result);
            $mybtcprice = $result[0];


//            $shipping = new \src\Shipping;
//            $shipment = new \src\Shipment();
            $shipping = $entityManager->getRepository('\src\Shipping')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
            $shipment = $entityManager->getRepository('\src\Shipment')->findOneBy(array('order_id' => $orderItem->getOrder_id()));

            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());

            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDatePurchased($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());

            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());
            $customOrder->setCode($orderItem->getCode());
            $customOrder->setQuantity($orderItem->getQuantity());
            $customOrder->setCountry($shipping->getCountry());
            $customOrder->setTrackingNumber($shipment->getTracking_number());
            $customOrder->setCurrentDate(null);

//            fetch sku data to the customer order
            $shull_data = $entityManager->getConnection()->fetchAll('select TITLE,SKUDescription from skus where SKU="' . $customOrder->getCode() . '"')[0];
//            var_dump($shull_data);
            $customOrder->setTitle($shull_data['TITLE']);
            $customOrder->setSKUDescription($shull_data['SKUDescription']);

//            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
//            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
//            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';
///            calcultate the price given by the formula
            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock();
//            echo $price;
            $customOrder->setBTCValue($price);
            unset($dql);
            unset($query);
            unset($result);

            $dql = $entityManager->createQueryBuilder();
//                search for the last btc on the date informed
            $query = $dql->select('btc')
                            ->from('\src\myethprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
//            echo 'count--' . count($result).'==== ';
//            var_dump($result);
            $mybtcprice = $result[0];
//            /            calcultate the price given by the formula
            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock();
//            echo $price;
//            setting ETH VALUE
            $customOrder->setETHValue($price);

            $entityManager->persist($customOrder);
            $entityManager->flush();
        }
    }
}


// ------------------------EXP001------------------

$list = $entityManager->getRepository('\src\OrderItem')->findBy(array('code' => 'EXP001'));
//var_dump($list);
echo 'NUmber ocourrences - ' . count($list);
if (count($list) > 0) {

    $orderItem = new src\OrderItem;
    $order = new src\Order;
    foreach ($list as $orderItem) {
//           get the full order information
        $order = $entityManager->getRepository('\src\Order')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
        if (count($entityManager->getRepository('\src\CustomerOrders')->findBy(array('order_id' => $orderItem->getOrder_id()))) == 0) {
//        echo 'id ---'.$orderItem->getOrder_id();
//        var_dump($order);
            $timestamp = $order->getDate_added();

            $dql = $entityManager->createQueryBuilder();
//                search for the last btc on the date informed
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
            echo 'count--' . count($result) . '==== ';
//            var_dump($result);
            $mybtcprice = $result[0];


            $shipping = $entityManager->getRepository('\src\Shipping')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//        $shipment =new src\Shipment;
            $shipment = $entityManager->getRepository('\src\Shipment')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//             var_dump($shipment);


            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());

            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDatePurchased($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());

            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());

            $customOrder->setCode($orderItem->getCode());
            $customOrder->setQuantity($orderItem->getQuantity());
            $customOrder->setCountry($shipping->getCountry());
            $customOrder->setTrackingNumber($shipment->getTracking_number());
            $customOrder->setCurrentDate(null);

            //            fetch sku data to the customer order
            $shull_data = $entityManager->getConnection()->fetchAll('select TITLE,SKUDescription from skus where SKU="' . $customOrder->getCode() . '"')[0];
//            var_dump($shull_data);
            $customOrder->setTitle($shull_data['TITLE']);
            $customOrder->setSKUDescription($shull_data['SKUDescription']);


            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';

//            rpice given by formula
            
            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() / 5;
            echo $price;
            $customOrder->setPrice_btc($mybtcprice->getFiftyBlock());
            unset($dql);


            echo '==== utc = ' . $order->getDate_added();
            $data = array();
//            get all the top1 - 5 data to set up on the customerorders
            for ($i = 1; $i < 6; $i++) {
                $query = $entityManager->createQuery('SELECT u FROM src\TopTen u WHERE '
                                . 'u.last_updated<=\'' . $order->getDate_added() . '\''
                                . ' and u.rank =' . $i
                                . ' order by u.last_updated DESC,u.rank asc'
                                . ' ')->setMaxResults(1);
                $top = $query->execute();
//            var_dump($top);
                $data['top' . $i] = $price / $top[0]->getPrice_btc();
                $data['top' . $i . '_name'] = $top[0]->getName();
            }
//            echo var_dump($data);
            $customOrder->setTop1($data['top1']);
            $customOrder->setTop1Description($data['top1_name']);
            $customOrder->setTop2($data['top2']);
            $customOrder->setTop2Description($data['top2_name']);
            $customOrder->setTop3($data['top3']);
            $customOrder->setTop3Description($data['top3_name']);
            $customOrder->setTop4($data['top4']);
            $customOrder->setTop4Description($data['top4_name']);
            $customOrder->setTop5($data['top5']);
            $customOrder->setTop5Description($data['top5_name']);
            $entityManager->persist($customOrder);
            $entityManager->flush();
        }
    }
}

// ------------------------VIS001------------------

$list = $entityManager->getRepository('\src\OrderItem')->findBy(array('code' => 'VIS001'));
//var_dump($list);
echo 'NUmber ocourrences - ' . count($list);
if (count($list) > 0) {

    $orderItem = new src\OrderItem;
    $order = new src\Order;
    foreach ($list as $orderItem) {
//           get the full order information
        $order = $entityManager->getRepository('\src\Order')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//        check if its on the customer order, if not go on
        if (count($entityManager->getRepository('\src\CustomerOrders')->findBy(array('order_id' => $orderItem->getOrder_id()))) == 0) {
        echo 'id ---'.$orderItem->getOrder_id();
//        var_dump($order);
            $timestamp = $order->getDate_added();

            $dql = $entityManager->createQueryBuilder();
//                search for the last btc on the date informed
            $query = $dql->select('btc')
                            ->from('\src\mybtcprices', 'btc')->
                            where('btc.utc<= \'' . $timestamp . '\'')
                            ->orderBy('btc.utc', ' desc')
                            ->setMaxResults(1)->getQuery();
            $result = $query->getResult();
//            echo 'count--' . count($result).'==== ';
//            var_dump($result);
            $mybtcprice = $result[0];

            $shipping = $entityManager->getRepository('\src\Shipping')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//        $shipment =new src\Shipment;
            $shipment = $entityManager->getRepository('\src\Shipment')->findOneBy(array('order_id' => $orderItem->getOrder_id()));
//             var_dump($shipment);



            $customOrder = new src\CustomerOrders();
            $customOrder->setSource_id($order->getSource_id());
            $customOrder->setOrder_id($order->getId_order());
            $customOrder->setEmail($order->getEmail());

            $customOrder->setDate_added($order->getDate_added());
            $customOrder->setDatePurchased($order->getDate_added());
            $customOrder->setDate_updated($order->getDate_updated());

            $customOrder->setOrder_total($order->getOrder_total() * $order->getQuantity_total());
            $customOrder->setCode($orderItem->getCode());
            $customOrder->setQuantity($orderItem->getQuantity());
            $customOrder->setCountry($shipping->getCountry());
            $customOrder->setTrackingNumber($shipment->getTracking_number());
            $customOrder->setCurrentDate(null);
//            fetch sku data to the customer order
            $shull_data = $entityManager->getConnection()->fetchAll('select TITLE,SKUDescription from skus where SKU="' . $customOrder->getCode() . '"')[0];
//            var_dump($shull_data);
            $customOrder->setTitle($shull_data['TITLE']);
            $customOrder->setSKUDescription($shull_data['SKUDescription']);

//            echo '$orderItem->getQuantity()  - ' . $orderItem->getQuantity();
//            echo '  / $mybtcprice->getFiftyBlock()  - ' . $mybtcprice->getFiftyBlock();
//            echo '  / $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() = ' . $orderItem->getQuantity() * $mybtcprice->getFiftyBlock() . ' /';

            $price = $orderItem->getQuantity() * $mybtcprice->getFiftyBlock();
//            echo $price;
            $customOrder->setPrice_btc($mybtcprice->getFiftyBlock());
            unset($dql);


            $data = array();
            $i = 1;
//            example SYMBOLCOIN => %
            $fetch = array('BTC' => 0.05, 'XMR' => 0.1, 'DASH' => 0.1
                , 'SC' => 0.2,
                'STRAT' => 0.2,
                'SYS' => 0.35
            );
//            fetch all vision given by the array
            foreach ($fetch as $key => $value) {
                $query = $entityManager->createQuery('SELECT u FROM src\Currency u WHERE '
                                . 'u.last_updated<=\'' . $order->getDate_added() . '\''
                                . ' and u.symbol =\'' . $key . '\''
                                . ' order by u.last_updated DESC'
                                . ' ')->setMaxResults(1);

                $top = $query->execute();
//                calculate each by his top data
                $data['vision' . $i] = $price * $value / $top[0]->getPrice_btc();
                $data['vision' . $i . '_name'] = $top[0]->getName();
                $i++;
            }


//            var_dump($data);
//            set up all the data
            $customOrder->setVision1($data['vision1']);
            $customOrder->setVision1Description($data['vision1_name']);
            $customOrder->setVision2($data['vision2']);
            $customOrder->setVision2Description($data['vision2_name']);
            $customOrder->setVision3($data['vision3']);
            $customOrder->setVision3Description($data['vision3_name']);
            $customOrder->setVision4($data['vision4']);
            $customOrder->setVision4Description($data['vision4_name']);
            $customOrder->setVision5($data['vision5']);
            $customOrder->setVision5Description($data['vision5_name']);
            $customOrder->setVision6($data['vision6']);
            $customOrder->setVision6Description($data['vision6_name']);

            $entityManager->persist($customOrder);
            $entityManager->flush();
        }
    }
}

  $curre = $entityManager->getRepository('\src\TopTen')->findBy(
                array('symbol' => 'BTC'
                ), array('id' => 'DESC'), 1);
        $curre= $curre[0];

        $entityManager->getConnection()->exec('update customerorders set avgUSDPrice='.$curre->getAVGUSDPrice().'; ');
        $entityManager->getConnection()->exec('update customerorders set avgCADPrice='.$curre->getAVGCADPrice().' ; ');
        
    