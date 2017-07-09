<?php

namespace src;

/**
 * @Entity @Table(name="shippments") @Entity(repositoryClass="OrdersRepository")
 * */
class Shipments {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @Column(type="string") * */
    private $first_name;
    private $last_name;
    private $company;
    private $address1;
    private $address2;
    private $address3;
    private $address4;
    private $city;
    private $state;
    private $postal_code;
    private $country;
    private $phone;

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

    function getFirst_name() {
        return $this->first_name;
    }

    function getLast_name() {
        return $this->last_name;
    }

    function getCompany() {
        return $this->company;
    }

    function getAddress1() {
        return $this->address1;
    }

    function getAddress2() {
        return $this->address2;
    }

    function getAddress3() {
        return $this->address3;
    }

    function getAddress4() {
        return $this->address4;
    }

    function getCity() {
        return $this->city;
    }

    function getState() {
        return $this->state;
    }

    function getPostal_code() {
        return $this->postal_code;
    }

    function getCountry() {
        return $this->country;
    }

    function getPhone() {
        return $this->phone;
    }

    function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    function setLast_name($last_name) {
        $this->last_name = $last_name;
    }

    function setCompany($company) {
        $this->company = $company;
    }

    function setAddress1($address1) {
        $this->address1 = $address1;
    }

    function setAddress2($address2) {
        $this->address2 = $address2;
    }

    function setAddress3($address3) {
        $this->address3 = $address3;
    }

    function setAddress4($address4) {
        $this->address4 = $address4;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setPostal_code($postal_code) {
        $this->postal_code = $postal_code;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }


    
}
