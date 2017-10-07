<?php

class CalculatorAVG {

    public static function calculateBtcAndEth($entityManager, $prices) {

        $stm = $entityManager->getConnection()->executeQuery('SELECT sum(myrate) as myrate,sum(FiftyBlock) as FiftyBlock,count(id) as cont  FROM `' . $prices->getTablename() . '` WHERE `date_added` =  ' . " ' " . $prices->getDate_added() . " '");
        $data = $stm->fetch();
        $myrateAVG = ($data['myrate'] + $prices->getMyrate()) / ($data['cont'] + 1);
        $fifthblockAVG = ($data['FiftyBlock'] + $prices->getFiftyBlock()) / ($data['cont'] + 1);

        $prices->setAVGMyRate($myrateAVG);
        $prices->setAVGFiftyBlock($fifthblockAVG);
        return $prices;
    }

    public static function calculateVisAndTop($entityManager, $prices) {

        $stm = $entityManager->getConnection()->executeQuery('SELECT sum(price_usd) as price_usd,sum(price_cad) as price_cad,sum(price_btc) as price_btc,count(id) as cont  FROM `' . $prices->getTablename() . '` WHERE date_added =  ' . " ' " . $prices->getDate_added() . "' and symbol ='" . $prices->getSymbol() . "'");
        $data = $stm->fetch();
        $AVGUSDPrice = ($data['price_usd'] + $prices->getPrice_usd()) / ($data['cont'] + 1);
        $AVGCADPrice = ($data['price_cad'] + $prices->getPrice_cad()) / ($data['cont'] + 1);
        $AVGBTCPrice = ($data['price_btc'] + $prices->getPrice_btc()) / ($data['cont'] + 1);


        $prices->setAVGUSDPrice($AVGUSDPrice);
        $prices->setAVGCADPrice($AVGCADPrice);
        $prices->setAVGBTCPrice($AVGBTCPrice);
        return $prices;
    }

    public static function updateBtcAndEth($entityManager, \src\CustomerOrders $customOrder,$coin) {

//        brc
        $topten = new src\TopTen();
        $topten = $entityManager->getRepository('\src\TopTen')->findBy(
                array('symbol' => 'BTC',
            'date_added' => gmdate('Y-m-d', time())
                ), array('id' => 'DESC'), 1);
        $topten = $topten[0];

        $customOrder->setCurrentBTCValue($customOrder->getBTCValue() * $topten->{'getAVG'.$coin.'Price'}());

//        eth
        $topten = $entityManager->getRepository('\src\TopTen')->findBy(
                array('symbol' => 'ETH',
            'date_added' => gmdate('Y-m-d', time())
                ), array('id' => 'DESC'), 1);
        $topten = $topten[0];

        $customOrder->setCurrentETHValue($customOrder->getETHValue() * $topten->{'getAVG'.$coin.'Price'}());

// top 1-5
        for ($i = 1; $i < 6; $i++) {
            $topten = $entityManager->getRepository('\src\TopTen')->findBy(
                    
                    array('name' => $customOrder->{'getTop' . $i . 'Description'}(),
                'date_added' => gmdate('Y-m-d', time())
                    ), array('id' => 'DESC'), 1);
            $topten = $topten[0];

            $customOrder->{'setCurrentTop' . $i}($customOrder->{'getTop'.$i}() * $topten->{'getAVG'.$coin.'Price'}());
        }
        
//        vision 1-6
        for ($i = 1; $i < 7; $i++) {
            $topten = $entityManager->getRepository('\src\Currency')->findBy(                    
                    array('name' => $customOrder->{'getVision' . $i . 'Description'}(),
                'date_added' => gmdate('Y-m-d', time())
                    ), array('id' => 'DESC'), 1);
            $topten = $topten[0];

            $customOrder->{'setCurrentVision' . $i}($customOrder->{'getVision'.$i}() * $topten->{'getAVG'.$coin.'Price'}());
        }

        return $customOrder;
    }

}
