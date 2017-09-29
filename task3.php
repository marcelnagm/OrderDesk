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
require_once __DIR__ . '/src/Currency.php';
require_once __DIR__ . '/src/MyETHPrices.php';
require_once __DIR__ . '/src/mybtcprices.php';
require_once __DIR__ . '/vendor/CalculatorAVG.php';


//// the connection configuration
require './config.inc';
// 
//
//
//start the connection with db.
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
    

//retrive data from btcprices
//    
    $ch = curl_init();
    /**
     * Initialize the cURL session
     */
    /**
     * Set the URL of the page or file to download.
     */
    curl_setopt($ch, CURLOPT_URL, 'https://api.quadrigacx.com/v2/ticker?book=BTC_CAD');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);
    $resp = json_decode($resp, true);
//    print_r($resp);
    
   $btc =  new src\mybtcprices($resp); 
   $btc = CalculatorAVG::calculateBtcAndEth($entityManager,$btc);
   
    $entityManager->persist($btc);
    
    $entityManager->flush();         
    
    
    curl_close($ch);

//retrive data from ethprices
//    
    $ch = curl_init();
    /**
     * Initialize the cURL session
     */
    /**
     * Set the URL of the page or file to download.
     */
    curl_setopt($ch, CURLOPT_URL, 'https://api.quadrigacx.com/v2/ticker?book=ETH_CAD');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);
    $resp = json_decode($resp, true);
//    print_r($resp);
    
   $btc =  new src\myethprices($resp); 
   $btc = CalculatorAVG::calculateBtcAndEth($entityManager,$btc);
    
    $entityManager->persist($btc);
//    
    $entityManager->flush();            
    curl_close($ch);


