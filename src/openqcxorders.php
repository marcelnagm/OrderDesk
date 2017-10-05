<?php

namespace src;

/**
 * @Entity @Table(name="openqcxorders") @Entity(repositoryClass="OrderRepository")
 * */
class openqcxorders{



        /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

     /** @Column(type="string") * */
    private $Amount;
    
     /** @Column(type="string") * */
    private $DateTime_Added;
    
     /** @Column(type="string") * */
    private $ID_Value;
     
    /** @Column(type="string") * */
    private $Price;
    
    /** @Column(type="string") * */
       private $Status;
       
    /** @Column(type="string") * */
       private $Type;
       
    
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
        return $this->Amount;
    }

    function getDateTime_Added() {
        return $this->DateTime_Added;
    }

    function getID_Value() {
        return $this->ID_Value;
    }

    function getPrice() {
        return $this->Price;
    }

    function getStatus() {
        return $this->Status;
    }

    function getType() {
        return $this->Type;
    }

    function setAmount() {
        return $this->Amount;
    }

    function setDateTime_Added() {
        return $this->DateTime_Added;
    }

    function setID_Value() {
        return $this->ID_Value;
    }

    function setPrice() {
        return $this->Price;
    }

    function setStatus() {
        return $this->Status;
    }

    function setType() {
        return $this->Type;
    }


    
}


