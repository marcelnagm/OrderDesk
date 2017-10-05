<?php

namespace src;

/**
 * @Entity @Table(name="openqcxorders") @Entity(repositoryClass="OrderRepository")
 * */
class openqcxorders{



        /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

     /** @Column(type="string") * */
    private $amount;
    
     /** @Column(type="string") * */
    private $datetime_added;
    
     /** @Column(type="string") * */
    private $ID_Value;
     
    /** @Column(type="string") * */
    private $price;
    
    /** @Column(type="string") * */
       private $status;
       
    /** @Column(type="string") * */
       private $type;
       
    
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


    function getAmount() {
        return $this->amount;
    }

    function getDatetime_added() {
        return $this->datetime_added;
    }

    function getID_Value() {
        return $this->ID_Value;
    }

    function getPrice() {
        return $this->price;
    }

    function getStatus() {
        return $this->status;
    }

    function getType() {
        return $this->type;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function setDatetime_added($datetime_added) {
        $this->datetime_added = $datetime_added;
    }

    function setID_Value($ID_Value) {
        $this->ID_Value = $ID_Value;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setType($type) {
        $this->type = $type;
    }


    
}


