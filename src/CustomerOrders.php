<?php

namespace src;

/**
 * @Entity @Table(name="customerorders") @Entity(repositoryClass="OrderRepository")
 * */
class CustomerOrders{

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;    
    
    /** @Column(type="string") * */
    private $source_id;
    
    /** @Column(type="string") * */
    private $order_id;
    
    /** @Column(type="string") * */
    private $email;
    /** @Column(type="string") * */
    private $price_btc;
    
    /** @Column(type="string") * */
    private $date_added;
    
    /** @Column(type="string") * */
    private $date_updated;
    
    /** @Column(type="string") * */
    private $order_total;
    
    /** @Column(type="string") * */
    private $code;
    
    /** @Column(type="string") * */
    private $BTCValue;
    
    /** @Column(type="string") * */
    private $ETHValue;
    
    /** @Column(type="string") * */
    private $Top1;
    /** @Column(type="string") * */
    private $Top2;
    /** @Column(type="string") * */
    private $Top3;
    /** @Column(type="string") * */
    private $Top4;
    /** @Column(type="string") * */
    private $Top5;
    /** @Column(type="string") * */
    private $Vision1;
    /** @Column(type="string") * */
    private $Vision2;
    /** @Column(type="string") * */
    private $Vision3;
    /** @Column(type="string") * */
    private $Vision4;
    /** @Column(type="string") * */
    private $Vision5;
    /** @Column(type="string") * */
    private $Vision6;

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
    
    public function setData($array = null) {
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

    function getSource_id() {
        return $this->source_id;
    }

    function getOrder_id() {
        return $this->order_id;
    }

    function getEmail() {
        return $this->email;
    }

    function getDate_added() {
        return $this->date_added;
    }

    function getDate_updated() {
        return $this->date_updated;
    }

    function getOrder_total() {
        return $this->order_total;
    }

    function getCode() {
        return $this->code;
    }

    function getBTCValue() {
        return $this->BTCValue;
    }

    function getETHValue() {
        return $this->ETHValue;
    }

    function getTop1() {
        return $this->Top1;
    }

    function getTop2() {
        return $this->Top2;
    }

    function getTop3() {
        return $this->Top3;
    }

    function getTop4() {
        return $this->Top4;
    }

    function getTop5() {
        return $this->Top5;
    }

    function getVision1() {
        return $this->Vision1;
    }

    function getVision2() {
        return $this->Vision2;
    }

    function getVision3() {
        return $this->Vision3;
    }

    function getVision4() {
        return $this->Vision4;
    }

    function getVision5() {
        return $this->Vision5;
    }

    function getVision6() {
        return $this->Vision6;
    }

    function setSource_id($source_id) {
        $this->source_id = $source_id;
    }

    function setOrder_id($order_id) {
        $this->order_id = $order_id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDate_added($date_added) {
        $this->date_added = $date_added;
    }

    function setDate_updated($date_updated) {
        $this->date_updated = $date_updated;
    }

    function setOrder_total($order_total) {
        $this->order_total = $order_total;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setBTCValue($BTCValue) {
        $this->BTCValue = $BTCValue;
    }

    function setETHValue($ETHValue) {
        $this->ETHValue = $ETHValue;
    }

    function setTop1($Top1) {
        $this->Top1 = $Top1;
    }

    function setTop2($Top2) {
        $this->Top2 = $Top2;
    }

    function setTop3($Top3) {
        $this->Top3 = $Top3;
    }

    function setTop4($Top4) {
        $this->Top4 = $Top4;
    }

    function setTop5($Top5) {
        $this->Top5 = $Top5;
    }

    function setVision1($Vision1) {
        $this->Vision1 = $Vision1;
    }

    function setVision2($Vision2) {
        $this->Vision2 = $Vision2;
    }

    function setVision3($Vision3) {
        $this->Vision3 = $Vision3;
    }

    function setVision4($Vision4) {
        $this->Vision4 = $Vision4;
    }

    function setVision5($Vision5) {
        $this->Vision5 = $Vision5;
    }

    function setVision6($Vision6) {
        $this->Vision6 = $Vision6;
    }

    function getPrice_btc() {
        return $this->price_btc;
    }

    function setPrice_btc($price_btc) {
        $this->price_btc = $price_btc;
    }


    
}
