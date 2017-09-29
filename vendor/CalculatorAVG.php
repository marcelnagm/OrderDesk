<?php

class CalculatorAVG{
    
    
    public static function  calculateBtcAndEth($entityManager,$prices){
        
        $stm = $entityManager->getConnection()->executeQuery('SELECT sum(myrate) as myrate,sum(FiftyBlock) as FiftyBlock,count(id) as cont  FROM `'.$prices->getTablename().'` WHERE `date_added` =  '." ' ".$prices->getDate_added()." '" );
        $data = $stm->fetch();
        $myrateAVG = ($data['myrate'] +$prices->getMyrate())/$data['cont']+1;
        $fifthblockAVG = ($data['FiftyBlock'] +$prices->getFiftyBlock())/$data['cont']+1;
        
        $prices->setAVGMyRate($myrateAVG);
        $prices->setAVGFiftyBlock($fifthblockAVG);
        return $prices;
    }
    
    public static function  calculateVisAndTop($entityManager, $prices){
        
        $stm = $entityManager->getConnection()->executeQuery('SELECT sum(price_usd) as price_usd,sum(price_cad) as price_cad,sum(price_btc) as price_btc,count(id) as cont  FROM `'.$prices->getTablename().'` WHERE date_added =  '." ' ".$prices->getDate_added()."' and symbol ='".$prices->getSymbol()."'" );
        $data = $stm->fetch();
        $AVGUSDPrice = ($data['price_usd'] +$prices->getPrice_usd())/$data['cont']+1;
        $AVGCADPrice = ($data['price_cad'] +$prices->getPrice_cad())/$data['cont']+1;
        $AVGBTCPrice  = ($data['price_btc'] +$prices->getPrice_btc())/$data['cont']+1;
        
        
        $prices->setAVGUSDPrice($AVGUSDPrice);
        $prices->setAVGCADPrice($AVGCADPrice);
        $prices->setAVGBTCPrice($AVGBTCPrice);
        return $prices;
    }
    
    
}