<?php

class CalculatorAVG {

    public static function calculateBtcAndEth($entityManager, $prices) {
        
//        using sql , get all myrate sum and the number of elemets
        $stm = $entityManager->getConnection()->executeQuery('SELECT sum(myrate) as myrate,sum(FiftyBlock) as FiftyBlock,count(id) as cont  FROM `' . $prices->getTablename() . '` WHERE `date_added` =  ' . " ' " . $prices->getDate_added() . " '");
        $data = $stm->fetch();
//        caculate my rate by the total+ mine that i havnt persisted on the db / by the numers of element+ 
        $myrateAVG = ($data['myrate'] + $prices->getMyrate()) / ($data['cont'] + 1);
        //        caculate fifthbloch by the total+ mine that i havnt persisted on the db / by the numers of element+ 1
        $fifthblockAVG = ($data['FiftyBlock'] + $prices->getFiftyBlock()) / ($data['cont'] + 1);

        $prices->setAVGMyRate($myrateAVG);
        $prices->setAVGFiftyBlock($fifthblockAVG);
        return $prices;
    }

    public static function calculateVisAndTop($entityManager, $prices) {

        $stm = $entityManager->getConnection()->executeQuery('SELECT sum(price_usd) as price_usd,sum(price_cad) as price_cad,sum(price_btc) as price_btc,count(id) as cont  FROM `' . $prices->getTablename() . '` WHERE date_added =  ' . " ' " . $prices->getDate_added() . "' and symbol ='" . $prices->getSymbol() . "'");
        $data = $stm->fetch();
//        exactly way that calculate my rate and FiftyBLcok
        $AVGUSDPrice = ($data['price_usd'] + $prices->getPrice_usd()) / ($data['cont'] + 1);
        $AVGCADPrice = ($data['price_cad'] + $prices->getPrice_cad()) / ($data['cont'] + 1);
        $AVGBTCPrice = ($data['price_btc'] + $prices->getPrice_btc()) / ($data['cont'] + 1);


        $prices->setAVGUSDPrice($AVGUSDPrice);
        $prices->setAVGCADPrice($AVGCADPrice);
        $prices->setAVGBTCPrice($AVGBTCPrice);
        return $prices;
    }

    public static function updateBtcAndEth($entityManager, \src\CustomerOrders $customOrder) {

//        brc get the last BTC registry from toptenTable
        $topten = $entityManager->getRepository('\src\TopTen')->findBy(
                array('symbol' => 'BTC'
                ), array('id' => 'DESC'), 1);
        $topten = $topten[0];
        echo $topten->getId() . ' -- ' . $customOrder->getId();
        $customOrder->setCurrentBTCValue($customOrder->getBTCValue() * $topten->getAVGBTCPrice() * $customOrder->getQuantity());

//        eth get the last ETH registry from toptenTable
        $topten = $entityManager->getRepository('\src\TopTen')->findBy(
                array('symbol' => 'ETH',
                ), array('id' => 'DESC'), 1);
        $topten = $topten[0];

        $customOrder->setCurrentETHValue($customOrder->getETHValue() * $topten->getAVGBTCPrice());
//        echo var_dump($customOrder->getId());
// top 1-5
//        he check is is empty value, because vision dont have TopX ;)        
        if ($customOrder->{'getTop1Description'}() != NULL) {            
            for ($i = 1; $i < 6; $i++) {
//                this he dynamically wil search top 1 to 5 
                $topten = $entityManager->getRepository('\src\TopTen')->findBy(
                        array('name' => $customOrder->{'getTop' . $i . 'Description'}()
//                        GM date to get more accurate
                        , 'date_added' => gmdate('Y-m-d', time())
                        ), array('id' => 'DESC'), 1);
                $topten = $topten[0];
//                now he set the value at the customer orders 
//                $customOrder->{method-dinacly-formed-by-string-that-i-passed}
//                why the code is so small
                $customOrder->{'setCurrentTop' . $i}($customOrder->{'getTop' . $i}() * $topten->getAVGBTCPrice());
            }
        }
        unset($i);
//        vision 1-6
//         as the same on the top, but in the vision case
        if ($customOrder->{'getVision1Description'}() != NULL) {
//he will get dynamically he will get 1 - 6 vision
            for ($i = 1; $i < 7; $i++) {
                $topten = $entityManager->getRepository('\src\Currency')->findBy(
//                        here he search for the same name of VisionDescrition, last one
                        array('name' => $customOrder->{'getVision' . $i . 'Description'}()
                        , 'date_added' => gmdate('Y-m-d', time())
                        ), array('id' => 'DESC'), 1);
//                var_dump($topten);
                $topten = $topten[0];
//                dynamically set up the value
                $customOrder->{'setCurrentVision' . $i}($customOrder->{'getVision' . $i}() * $topten->getAVGBTCPrice());
            }
        }

        return $customOrder;
    }

}
