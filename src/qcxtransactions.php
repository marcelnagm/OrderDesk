<?php

namespace src;

/**
 * @Entity @Table(name="qcxtransactions") @Entity(repositoryClass="OrderRepository")
 * */
class qcxtransactions{



        /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

     /** @Column(type="string") * */
    private $btc_available;
     /** @Column(type="string") * */
    private $btc_reserved;
     /** @Column(type="string") * */
    private $btc_balance;
     /** @Column(type="string") * */
    private $bch_available;
     /** @Column(type="string") * */
    private $bch_balance;
     /** @Column(type="string") * */
    private $eth_available;
     /** @Column(type="string") * */
    private $eth_reserved;
     /** @Column(type="string") * */
    private $eth_balance;
     /** @Column(type="string") * */
    private $ltc_available;
     /** @Column(type="string") * */
    private $ltc_reserved;
     /** @Column(type="string") * */
    private $ltc_balance;
     /** @Column(type="string") * */
    private $etc_available;
     /** @Column(type="string") * */
    private $etc_reserved;
     /** @Column(type="string") * */
    private $etc_balance;
     /** @Column(type="string") * */
    private $cad_available;
     /** @Column(type="string") * */
    private $cad_reserved;
     /** @Column(type="string") * */
    private $cad_balance;
     /** @Column(type="string") * */
    private $usd_available;
     /** @Column(type="string") * */
    private $usd_reserved;
     /** @Column(type="string") * */
    private $usd_balance;
     /** @Column(type="string") * */
    private $xau_available;
     /** @Column(type="string") * */
    private $xau_reserved;
     /** @Column(type="string") * */
    private $xau_balance;
     /** @Column(type="string") * */
    private $fee;
     /** @Column(type="string") * */
    private $fees;
    
       
    
    public function __construct($array = null) {
        if (is_array($array)) {         
            $fields = get_class_vars(__CLASS__);
            unset($fields['id']);
            foreach ($fields as $field => $value) {
                if (isset($array[$field])) {

                    $this->{'set' . ucfirst($field)}($array[$field]);
                }
            }
        }
    }


    function getId() {
        return $this->id;
    }


    function getBtc_available() {
        return $this->btc_available;
    }

    function getBtc_reserved() {
        return $this->btc_reserved;
    }

    function getBtc_balance() {
        return $this->btc_balance;
    }

    function getBch_available() {
        return $this->bch_available;
    }

    function getBch_balance() {
        return $this->bch_balance;
    }

    function getEth_available() {
        return $this->eth_available;
    }

    function getEth_reserved() {
        return $this->eth_reserved;
    }

    function getEth_balance() {
        return $this->eth_balance;
    }

    function getLtc_available() {
        return $this->ltc_available;
    }

    function getLtc_reserved() {
        return $this->ltc_reserved;
    }

    function getLtc_balance() {
        return $this->ltc_balance;
    }

    function getEtc_available() {
        return $this->etc_available;
    }

    function getEtc_reserved() {
        return $this->etc_reserved;
    }

    function getEtc_balance() {
        return $this->etc_balance;
    }

    function getCad_available() {
        return $this->cad_available;
    }

    function getCad_reserved() {
        return $this->cad_reserved;
    }

    function getCad_balance() {
        return $this->cad_balance;
    }

    function getUsd_available() {
        return $this->usd_available;
    }

    function getUsd_reserved() {
        return $this->usd_reserved;
    }

    function getUsd_balance() {
        return $this->usd_balance;
    }

    function getXau_available() {
        return $this->xau_available;
    }

    function getXau_reserved() {
        return $this->xau_reserved;
    }

    function getXau_balance() {
        return $this->xau_balance;
    }

    function getFee() {
        return $this->fee;
    }

    function getFees() {
        return json_decode($this->fees);
    }

    function setBtc_available($btc_available) {
        $this->btc_available = $btc_available;
    }

    function setBtc_reserved($btc_reserved) {
        $this->btc_reserved = $btc_reserved;
    }

    function setBtc_balance($btc_balance) {
        $this->btc_balance = $btc_balance;
    }

    function setBch_available($bch_available) {
        $this->bch_available = $bch_available;
    }

    function setBch_balance($bch_balance) {
        $this->bch_balance = $bch_balance;
    }

    function setEth_available($eth_available) {
        $this->eth_available = $eth_available;
    }

    function setEth_reserved($eth_reserved) {
        $this->eth_reserved = $eth_reserved;
    }

    function setEth_balance($eth_balance) {
        $this->eth_balance = $eth_balance;
    }

    function setLtc_available($ltc_available) {
        $this->ltc_available = $ltc_available;
    }

    function setLtc_reserved($ltc_reserved) {
        $this->ltc_reserved = $ltc_reserved;
    }

    function setLtc_balance($ltc_balance) {
        $this->ltc_balance = $ltc_balance;
    }

    function setEtc_available($etc_available) {
        $this->etc_available = $etc_available;
    }

    function setEtc_reserved($etc_reserved) {
        $this->etc_reserved = $etc_reserved;
    }

    function setEtc_balance($etc_balance) {
        $this->etc_balance = $etc_balance;
    }

    function setCad_available($cad_available) {
        $this->cad_available = $cad_available;
    }

    function setCad_reserved($cad_reserved) {
        $this->cad_reserved = $cad_reserved;
    }

    function setCad_balance($cad_balance) {
        $this->cad_balance = $cad_balance;
    }

    function setUsd_available($usd_available) {
        $this->usd_available = $usd_available;
    }

    function setUsd_reserved($usd_reserved) {
        $this->usd_reserved = $usd_reserved;
    }

    function setUsd_balance($usd_balance) {
        $this->usd_balance = $usd_balance;
    }

    function setXau_available($xau_available) {
        $this->xau_available = $xau_available;
    }

    function setXau_reserved($xau_reserved) {
        $this->xau_reserved = $xau_reserved;
    }

    function setXau_balance($xau_balance) {
        $this->xau_balance = $xau_balance;
    }

    function setFee($fee) {
        $this->fee = $fee;
    }

    function setFees($fees) {
        $this->fees = json_encode($fees);
    }


    
}


