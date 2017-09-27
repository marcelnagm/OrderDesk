<?php

namespace src;

/**
 * @Entity @Table(name="myethprices") @Entity(repositoryClass="OrderRepository")
 * */
class myethprices {
    
    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

     /** @Column(type="string") * */
    private $high;
    
     /** @Column(type="string") * */
    private $last;
    
     /** @Column(type="string") * */
    private $timestamp;
     
    /** @Column(type="string") * */
    private $utc;
    
    /** @Column(type="string") * */
       private $volume;
       
    /** @Column(type="string") * */
       private $vwap;
       
    /** @Column(type="string") * */
       private $low;
       
    /** @Column(type="string") * */
       private $ask;
       
    /** @Column(type="string") * */
       private $bid;
       
    /** @Column(type="string") * */
       private $myrate;
       
    /** @Column(type="string") * */
       private $FiftyBlock;   
    /** @Column(type="string") * */
    private $date_added;   
    
    
    public function __construct($array = null) {
        if (is_array($array)) {

            $fields = get_class_vars(__CLASS__);            
            unset($fields['id']);
            foreach ($fields as $field => $value) {
//                echo $field ;
//                echo "<br>";
                if (isset($array[$field])) {

                    $this->{'set' . ucfirst($field)}($array[$field]);
                }
            }
        }
        $this->setMyrate();
        $this->setFiftyBlock();
        $this->setUtc();
    }

    function getId() {
        return $this->id;
    }

    function getHigh() {
        return $this->high;
    }

    function getLast() {
        return $this->last;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function getVolume() {
        return $this->volume;
    }

    function getVwap() {
        return $this->vwap;
    }

    function getLow() {
        return $this->low;
    }

    function getAsk() {
        return $this->ask;
    }

    function getMyrate() {
        return $this->myrate;
    }

    function getFiftyBlock() {
        return $this->FiftyBlock;
    }

    function setHigh($high) {
        $this->high = $high;
    }

    function setLast($last) {
        $this->last = $last;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    function setVolume($volume) {
        $this->volume = $volume;
    }

    function setVwap($vwap) {
        $this->vwap = $vwap;
    }

    function setLow($low) {
        $this->low = $low;
    }

    function setAsk($ask) {
        $this->ask = $ask;
    }

    function getBid() {
        return $this->bid;
    }

    function setBid($bid) {
        $this->bid = $bid;
    }

        
    function setMyrate() {
        $this->myrate = $this->ask* 1.055;
    }

    function setFiftyBlock() {
        $this->FiftyBlock =  50 / $this->getMyrate() ;
    }


    function getUtc() {
        return $this->utc;
    }

    function setUtc() {
        $this->utc = gmdate('Y-m-d  G:i:s', $this->getTimestamp());
        $this->setDate_added($this->getTimestamp());
    }

    function getDate_added() {
        return $this->date_added;
    }

    function setDate_added($date_added) {
        $this->date_added = gmdate('Y-m-d', $date_added);
    }
    
}


