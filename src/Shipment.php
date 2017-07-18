<?php

namespace src;

/**
 * @Entity @Table(name="shipment") @Entity(repositoryClass="OrderRepository")
 * */
class Shipment {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;
    /** @Column(type="string") * */
    private $shipment_id;
    /** @Column(type="string") * */
    private $order_id;
    /** @Column(type="string") * */
    private $tracking_number;
    /** @Column(type="string") * */
    private $carrier_code;
    /** @Column(type="string") * */
    private $shipment_method;
    /** @Column(type="string") * */
    private $weight;
    /** @Column(type="string") * */
    private $cost;
    /** @Column(type="string") * */
    private $sstatus;
    /** @Column(type="string") * */
    private $tracking_url;
    /** @Column(type="string") * */
    private $date_shipped;
    /** @Column(type="string") * */
    private $date_added;
    /** @Column(type="string") * */
    private $source;

    
    

    public function __construct($array = null) {
        if (is_array($array)) {
            echo 'dada!!';
            $fields = get_class_vars(__CLASS__);
            $this->setShipment_id($array['id']);
            unset($fields['id']);
            foreach ($fields as $field => $value) {
//                echo $field ;
//                echo "<br>";
                if (isset($array[$field])) {

                    $this->{'set' . ucfirst($field)}($array[$field]);
                }
            }
        }
    }

    function getId() {
        return $this->id;
    }

    
    function getOrder_id() {
        return $this->order_id;
    }

    function getTracking_number() {
        return $this->tracking_number;
    }

    function getCarrier_code() {
        return $this->carrier_code;
    }

    function getShipment_method() {
        return $this->shipment_method;
    }

    function getWeight() {
        return $this->weight;
    }

    function getCost() {
        return $this->cost;
    }

    function getSstatus() {
        return $this->sstatus;
    }

    function getTracking_url() {
        return $this->tracking_url;
    }

    function setOrder_id($order_id) {
        $this->order_id = $order_id;
    }

    function setTracking_number($tracking_number) {
        $this->tracking_number = $tracking_number;
    }

    function setCarrier_code($carrier_code) {
        $this->carrier_code = $carrier_code;
    }

    function setShipment_method($shipment_method) {
        $this->shipment_method = $shipment_method;
    }

    function setWeight($weight) {
        $this->weight = $weight;
    }

    function setCost($cost) {
        $this->cost = $cost;
    }

    function setSstatus($sstatus) {
        $this->sstatus = $sstatus;
    }

    function setTracking_url($tracking_url) {
        $this->tracking_url = $tracking_url;
    }


    function getDate_shipped() {
        return $this->date_shipped;
    }

    function getDate_added() {
        return $this->date_added;
    }

    function setDate_shipped($date_shipped) {
        $this->date_shipped = $date_shipped;
    }

    function setDate_added($date_added) {
        $this->date_added = $date_added;
    }

    function getShipment_id() {
        return $this->shipment_id;
    }

    function setShipment_id($shipment_id) {
        $this->shipment_id = $shipment_id;
    }

    function getSource() {
        return $this->source;
    }

    function setSource($source) {
        $this->source = $source;
    }


    
}
