<?php

namespace src;

/**
 * @Entity @Table(name="qcxTransactions") @Entity(repositoryClass="OrderRepository")
 * */
class qcxTransactions{



        /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

     /** @Column(type="string") * */
    private $cad_balance;
    
     /** @Column(type="string") * */
    private $btc_balance;
    
     /** @Column(type="string") * */
    private $cad_reserved;
     
    /** @Column(type="string") * */
    private $btc_reserved;
    
    /** @Column(type="string") * */
       private $cad_available;
       
    /** @Column(type="string") * */
       private $btc_available;
       
    
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


    function getcad_balance() {
        return $this->cad_balance;
    }

    function getbtc_balance() {
        return $this->btc_balance;
    }

    function getcad_reserved() {
        return $this->cad_reserved;
    }

    function getbtc_reserved() {
        return $this->btc_reserved;
    }

    function getcad_available() {
        return $this->cad_available;
    }

    function getbtc_available() {
        return $this->btc_available;
    }

    function setcad_balance($cad_balance) {
        $this->cad_balance = $cad_balance;
    }

    function setbtc_balance($btc_balance) {
        $this->btc_balance= $btc_balance;
    }

    function setcad_reserved($cad_reserved) {
        $this->cad_reserved = $cad_reserved;
    }

    function setbtc_reserved($btc_reserved) {
        $this->btc_reserved = $btc_reserved;
    }

    function setcad_available($cad_available) {
        $this->cad_available = $cad_available;
    }

    function setbtc_available($btc_available) {
        $this->btc_available = $btc_available;
    }


    
}


