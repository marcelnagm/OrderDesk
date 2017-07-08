<?php

namespace src;

/**
 * @Entity @Table(name="shippments") @Entity(repositoryClass="OrdersRepository")
 * */
class Shipments {

/** @Id @Column(type="integer") @GeneratedValue * */
protected $id;
/** @Column(type="string") * */
protected $tracking_number ;// The carrier’s assigned tracking number. Use n/a if no tracking number is applicable.
/** @Column(type="string") * */
protected $carrier_code ;//Code like USPS or FedEx if available.
/** @Column(type="string") * */
protected $shipment_method ;//Name of shipping service, example: First Class International
/** @Column(type="float") * */
protected $weight ;//Final weight of shipment
/** @Column(type="float") * */
protected $cost;// Your cost to send shipment
/** @Column(type="string") * */
protected $status;// The shipment’s current status - used by EasyPost webhook
/** @Column(type="string") * */
protected $tracking_url;// If not entered, we will try to guess it based on tracking number format and carrier code


function getId() {
return $this->id;
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

function getStatus() {
    return $this->status;
}

function getTracking_url() {
    return $this->tracking_url;
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

function setStatus($status) {
    $this->status = $status;
}

function setTracking_url($tracking_url) {
    $this->tracking_url = $tracking_url;
}




}
