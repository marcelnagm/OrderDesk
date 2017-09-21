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


//// the connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '123',
    'dbname' => 'orderdesk',
    'host' => 'localhost',
);
// 
//
//
//start the connection with db.
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
//https://api.coinmarketcap.com/v1/ticker/syscoin/


//to add more visionary,just folow the example
$data_url_visionary = array(
    'https://api.coinmarketcap.com/v1/ticker/syscoin/',
    'https://api.coinmarketcap.com/v1/ticker/stratis/',
    'https://api.coinmarketcap.com/v1/ticker/siacoin/',
    'https://api.coinmarketcap.com/v1/ticker/dash/',
    'https://api.coinmarketcap.com/v1/ticker/Monero/',
    'https://api.coinmarketcap.com/v1/ticker/bitcoin/'
);


    
foreach ($data_url_visionary as $url) {
    $ch = curl_init();
    /**
     * Initialize the cURL session
     */
    /**
     * Set the URL of the page or file to download.
     */
      curl_setopt($ch, CURLOPT_URL, $url.'?convert=CAD');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);
    $resp = json_decode($resp, true);
    $data = $resp[0];
    $data['id_cap'] = $data['id'];
    $data['h24_volume_usd'] = $data['24h_volume_usd'];
    $data['h24_volume_cad'] = $data['24h_volume_cad'];
    unset($data['id']);
    unset($data['24h_volume_usd']);
    unset($data['24h_volume_cad']);

//    print_r($data);
    $curre = new src\Currency($data);
    
    
    curl_close($ch);
    $entityManager->persist($curre);
    
        
    unset($curre);
}
$entityManager->flush();


//session to retrive data from top ten
    $ch = curl_init();
    /**
     * Initialize the cURL session
     */
    /**
     * Set the URL of the page or file to download.
     */
//     change the value limit to retrive more
    curl_setopt($ch, CURLOPT_URL, 'https://api.coinmarketcap.com/v1/ticker/?limit=10&convert=CAD');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);
    $resp = json_decode($resp, true);
//    print_r($resp);
    echo count($resp);
    foreach ($resp as $data_raw){
    $data = $data_raw;
    $data['id_cap'] = $data['id'];
    $data['h24_volume_usd'] = $data['24h_volume_usd'];
    $data['h24_volume_cad'] = $data['24h_volume_cad'];
    unset($data['id']);
    unset($data['24h_volume_usd']);
    unset($data['24h_volume_cad']);

//    print_r($data);
    $curre = new src\TopTen($data);
//    print_r($curre);
    $entityManager->persist($curre);
    }
    $entityManager->flush();            
    curl_close($ch);
    
    
