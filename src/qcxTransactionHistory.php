<?php

namespace src;

/**
 * @Entity @Table(name="qcxTransactionHistory") @Entity(repositoryClass="OrderRepository")
 * */
class qcxTransactionHistory{



        /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

     /** @Column(type="string") * */
    private $cad;
     /** @Column(type="string") * */
    private $btc =0;
     /** @Column(type="string") * */
    private $eth =0;
     /** @Column(type="string") * */
    private $btc_cad =0;
     /** @Column(type="string") * */
    private $eth_cad=0;
     /** @Column(type="string") * */
    private $order_id = '';
     /** @Column(type="string") * */
    private $fee;
     /** @Column(type="string") * */
    private $rate ='';
     /** @Column(type="string") * */
    private $type;
     /** @Column(type="string") * */
    private $datetime;
     /** @Column(type="string") * */
    private $method = '';
    
       
    
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


    function getCad() {
        return $this->cad;
    }

    function getBtc() {
        return $this->btc;
    }

    function getBtc_cad() {
        return $this->btc_cad;
    }

    function getOrder_id() {
        return $this->order_id;
    }

    function getFee() {
        return $this->fee;
    }

    function getRate() {
        return $this->rate;
    }

    function getType() {
        return $this->type;
    }

    function getDatetime() {
        return $this->datetime;
    }

    function setCad($cad) {
        $this->cad = $cad;
    }

    function setBtc($btc) {
        $this->btc = $btc;
    }

    function setBtc_cad($btc_cad) {
        $this->btc_cad = $btc_cad;
    }

    function setOrder_id($order_id) {
        $this->order_id = $order_id;
    }

    function setFee($fee) {
        $this->fee = $fee;
    }

    function setRate($rate) {
        $this->rate = $rate;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setDatetime($datetime) {
        $this->datetime = $datetime;
    }


    function getEth() {
        return $this->eth;
    }

    function setEth($eth) {
        $this->eth = $eth;
    }


    function getMethod() {
        return $this->method;
    }

    function setMethod($method) {
        $this->method = $method;
    }

    function getEth_cad() {
        return $this->eth_cad;
    }

    function setEth_cad($eth_cad) {
        $this->eth_cad = $eth_cad;
    }


    
    
}


