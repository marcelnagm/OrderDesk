<?php

namespace src;

/**
 * @Entity @Table(name="orders") @Entity(repositoryClass="OrdersRepository")
 * */
class Order {

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;    
    /** @Column(type="integer") * */
    protected $source_id; //	Your order ID. If blank, Order Desks internal ID will be used READ-ONLY
    /** @Column(type="string") * */
    protected $source_name; //	Pick from Available Source Names. Defaults to Order Desk
    /** @Column(type="integer") * */
    protected $source_id2; //	The original ID # of the order. If nothing entered, Order Desks internal ID number will be used
    /** @Column(type="string") * */
    protected $email; //	Customers email address
    /** @Column(type="float") * */
    protected $quantity_total; //	The total number of all the items in the order READ-ONLY
    /** @Column(type="float") * */
    protected $product_total; //	The total price of all the items in the order READ-ONLY
    /** @Column(type="float") * */
    protected $shipping_total; //	The total price of shipping in the order
    /** @Column(type="float") * */
    protected $discount_total; //	The total price of all the discounts in the order stored as a positive number READ-ONLY
    /** @Column(type="float") * */
    protected $order_total; //	The total calculated price of the entire order READ-ONLY
    /** @Column(type="string") * */
    protected $cc_number; //	Obfuscated credit card number. Enter only the last four digits
    /** @Column(type="string") * */
    protected $cc_exp; //	Credit card expiration in format MM/YYYY
    /** @Column(type="string") * */
    protected $payment_type; //	Visa, MasterCard, PayPal, etc.
    /** @Column(type="string") * */
    protected $payment_status; //	Available options: Approved, Authorized, Captured, Fully Refunded, Partially Refunded, Pending, Rejected, or Voided. Default is Captured
    /** @Column(type="integer") * */
    protected $customer_id; //	The customer ID field from the originating shopping cart
    /** @Column(type="string") * */
    protected $email_count; //	The number of orders that match this email address READ-ONLY
    /** @Column(type="string") * */
    protected $ip_address; //	The customers IP address
    /** @Column(type="string") * */
    protected $fulfillment_name; //	Once the order has been sent for fulfillment, the name of the fulfillment method is entered here
    /** @Column(type="integer") * */
    protected $fulfillment_id; //	The internal ID of the fulfillment service will be saved here for some services
    /** @Column(type="date") * */
    protected $date_added; //	The order date stored in UTC
    /** @Column(type="date") * */
    protected $date_updated; //	The date that the order was last updated in UTC
    /** @Column(type="string") * */
    protected $checkout_data; //	Array with a list of extra order details in key => value format. Used when it may need to be manually edited in Order Desk.
    /** @Column(type="string") * */
    protected $order_metadata; //	Array with a list of extra (hidden) order details in key => value format
    /** @Column(type="string") * */
    protected $shipping; //	Array with shipping address details. If nothing is entered, the customer array will be copied to the shipping array. A first and last name combination or a company name must be entered to be a valid order.
    /** @Column(type="string") * */
    protected $customer; //	Array with customer address details. If nothing is entered, the shipping array will be copied to the customer array. A first and last name combination or a company name must be entered to be a valid order.
    /** @Column(type="string") * */
    protected $return_address; //	Array with return address details. Not required.
    /** @Column(type="string") * */
    protected $discount_list; //	Array with a list of discounts. See discount properties for reference.
    /** @Column(type="string") * */
    protected $order_notes; //	Array with a list of order notes. See order note properties for reference.
    /** @Column(type="string") * */
    protected $order_shipments; //	Array with a list of order shipments. See order shipments properties for reference.

    function getNome() {
        return $this->nome;
    }

    function getSource_id() {
        return $this->source_id;
    }

    function getSource_name() {
        return $this->source_name;
    }

    function getSource_id2() {
        return $this->source_id2;
    }

    function getEmail() {
        return $this->email;
    }

    function getQuantity_total() {
        return $this->quantity_total;
    }

    function getProduct_total() {
        return $this->product_total;
    }

    function getShipping_total() {
        return $this->shipping_total;
    }

    function getDiscount_total() {
        return $this->discount_total;
    }

    function getOrder_total() {
        return $this->order_total;
    }

    function getCc_number() {
        return $this->cc_number;
    }

    function getCc_exp() {
        return $this->cc_exp;
    }

    function getPayment_type() {
        return $this->payment_type;
    }

    function getPayment_status() {
        return $this->payment_status;
    }

    function getCustomer_id() {
        return $this->customer_id;
    }

    function getEmail_count() {
        return $this->email_count;
    }

    function getIp_address() {
        return $this->ip_address;
    }

    function getFulfillment_name() {
        return $this->fulfillment_name;
    }

    function getFulfillment_id() {
        return $this->fulfillment_id;
    }

    function getDate_added() {
        return $this->date_added;
    }

    function getDate_updated() {
        return $this->date_updated;
    }

    function getCheckout_data() {
        return $this->checkout_data;
    }

    function getOrder_metadata() {
        return $this->order_metadata;
    }

    function getShipping() {
        return $this->shipping;
    }

    function getCustomer() {
        return $this->customer;
    }

    function getReturn_address() {
        return $this->return_address;
    }

    function getDiscount_list() {
        return $this->discount_list;
    }

    function getOrder_notes() {
        return $this->order_notes;
    }

    function getOrder_shipments() {
        return $this->order_shipments;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSource_id($source_id) {
        $this->source_id = $source_id;
    }

    function setSource_name($source_name) {
        $this->source_name = $source_name;
    }

    function setSource_id2($source_id2) {
        $this->source_id2 = $source_id2;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setQuantity_total($quantity_total) {
        $this->quantity_total = $quantity_total;
    }

    function setProduct_total($product_total) {
        $this->product_total = $product_total;
    }

    function setShipping_total($shipping_total) {
        $this->shipping_total = $shipping_total;
    }

    function setDiscount_total($discount_total) {
        $this->discount_total = $discount_total;
    }

    function setOrder_total($order_total) {
        $this->order_total = $order_total;
    }

    function setCc_number($cc_number) {
        $this->cc_number = $cc_number;
    }

    function setCc_exp($cc_exp) {
        $this->cc_exp = $cc_exp;
    }

    function setPayment_type($payment_type) {
        $this->payment_type = $payment_type;
    }

    function setPayment_status($payment_status) {
        $this->payment_status = $payment_status;
    }

    function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
    }

    function setEmail_count($email_count) {
        $this->email_count = $email_count;
    }

    function setIp_address($ip_address) {
        $this->ip_address = $ip_address;
    }

    function setFulfillment_name($fulfillment_name) {
        $this->fulfillment_name = $fulfillment_name;
    }

    function setFulfillment_id($fulfillment_id) {
        $this->fulfillment_id = $fulfillment_id;
    }

    function setDate_added($date_added) {
        $this->date_added = $date_added;
    }

    function setDate_updated($date_updated) {
        $this->date_updated = $date_updated;
    }

    function setCheckout_data($checkout_data) {
        $this->checkout_data = $checkout_data;
    }

    function setOrder_metadata($order_metadata) {
        $this->order_metadata = $order_metadata;
    }

    function setShipping($shipping) {
        $this->shipping = $shipping;
    }

    function setCustomer($customer) {
        $this->customer = $customer;
    }

    function setReturn_address($return_address) {
        $this->return_address = $return_address;
    }

    function setDiscount_list($discount_list) {
        $this->discount_list = $discount_list;
    }

    function setOrder_notes($order_notes) {
        $this->order_notes = $order_notes;
    }

    function setOrder_shipments($order_shipments) {
        $this->order_shipments = $order_shipments;
    }


    
}
