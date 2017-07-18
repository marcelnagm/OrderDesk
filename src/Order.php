<?php

namespace src;

/**
 * @Entity @Table(name="orders") @Entity(repositoryClass="OrderRepository")
 * */
class Order {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @Column(type="string") * */
    private $order_id;

    /** @Column(type="string") * */
    private $email;

    /** @Column(type="string") * */
    private $shipping_method;

    /** @Column(type="string") * */
    private $quantity_total;

    /** @Column(type="string") * */
    private $weight_total;

    /** @Column(type="string") * */
    private $product_total;

    /** @Column(type="string") * */
    private $shipping_total;

    /** @Column(type="string") * */
    private $handling_total;

    /** @Column(type="string") * */
    private $tax_total;

    /** @Column(type="string") * */
    private $discount_total;

    /** @Column(type="string") * */
    private $order_total;

    /** @Column(type="string") * */
    private $cc_number_masked;

    /** @Column(type="string") * */
    private $cc_exp;

    /** @Column(type="string") * */
    private $processor_response;

    /** @Column(type="string") * */
    private $payment_type;

    /** @Column(type="string") * */
    private $payment_status;

    /** @Column(type="string") * */
    private $processor_balance;

    /** @Column(type="string") * */
    private $customer_id;

    /** @Column(type="string") * */
    private $email_count;

    /** @Column(type="string") * */
    private $ip_address;

    /** @Column(type="string") * */
    private $tag_color;

    /** @Column(type="string") * */
    private $source_name;

    /** @Column(type="string") * */
    private $source_id;

    /** @Column(type="string") * */
    private $fulfillment_name;

    /** @Column(type="string") * */
    private $fulfillment_id;

    /** @Column(type="string") * */
    private $tag_name;

    /** @Column(type="string") * */
    private $folder_id;

    /** @Column(type="string") * */
    private $date_added;

    /** @Column(type="string") * */
    private $date_updated;

    /** @Column(type="integer") * */
    private $shipping_id;

    public function __construct($array = null) {
        if (is_array($array)) {

            $fields = get_class_vars(__CLASS__);
            $this->setId_order($array['id']);
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

    function getId_order() {
        return $this->order_id;
    }

    function getEmail() {
        return $this->email;
    }

    function getShipping_method() {
        return $this->shipping_method;
    }

    function getQuantity_total() {
        return $this->quantity_total;
    }

    function getWeight_total() {
        return $this->weight_total;
    }

    function getProduct_total() {
        return $this->product_total;
    }

    function getShipping_total() {
        return $this->shipping_total;
    }

    function getHandling_total() {
        return $this->handling_total;
    }

    function getTax_total() {
        return $this->tax_total;
    }

    function getDiscount_total() {
        return $this->discount_total;
    }

    function getOrder_total() {
        return $this->order_total;
    }

    function getCc_number_masked() {
        return $this->cc_number_masked;
    }

    function getCc_exp() {
        return $this->cc_exp;
    }

    function getProcessor_response() {
        return $this->processor_response;
    }

    function getPayment_type() {
        return $this->payment_type;
    }

    function getPayment_status() {
        return $this->payment_status;
    }

    function getProcessor_balance() {
        return $this->processor_balance;
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

    function getTag_color() {
        return $this->tag_color;
    }

    function getSource_name() {
        return $this->source_name;
    }

    function getSource_id() {
        return $this->source_id;
    }

    function getFulfillment_name() {
        return $this->fulfillment_name;
    }

    function getFulfillment_id() {
        return $this->fulfillment_id;
    }

    function getTag_name() {
        return $this->tag_name;
    }

    function getFolder_id() {
        return $this->folder_id;
    }

    function getDate_added() {
        return $this->date_added;
    }

    function getDate_updated() {
        return $this->date_updated;
    }

    function setId_order($id_order) {
        $this->order_id = $id_order;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setShipping_method($shipping_method) {
        $this->shipping_method = $shipping_method;
    }

    function setQuantity_total($quantity_total) {
        $this->quantity_total = $quantity_total;
    }

    function setWeight_total($weight_total) {
        $this->weight_total = $weight_total;
    }

    function setProduct_total($product_total) {
        $this->product_total = $product_total;
    }

    function setShipping_total($shipping_total) {
        $this->shipping_total = $shipping_total;
    }

    function setHandling_total($handling_total) {
        $this->handling_total = $handling_total;
    }

    function setTax_total($tax_total) {
        $this->tax_total = $tax_total;
    }

    function setDiscount_total($discount_total) {
        $this->discount_total = $discount_total;
    }

    function setOrder_total($order_total) {
        $this->order_total = $order_total;
    }

    function setCc_number_masked($cc_number_masked) {
        $this->cc_number_masked = $cc_number_masked;
    }

    function setCc_exp($cc_exp) {
        $this->cc_exp = $cc_exp;
    }

    function setProcessor_response($processor_response) {
        $this->processor_response = $processor_response;
    }

    function setPayment_type($payment_type) {
        $this->payment_type = $payment_type;
    }

    function setPayment_status($payment_status) {
        $this->payment_status = $payment_status;
    }

    function setProcessor_balance($processor_balance) {
        $this->processor_balance = $processor_balance;
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

    function setTag_color($tag_color) {
        $this->tag_color = $tag_color;
    }

    function setSource_name($source_name) {
        $this->source_name = $source_name;
    }

    function setSource_id($source_id) {
        $this->source_id = $source_id;
    }

    function setFulfillment_name($fulfillment_name) {
        $this->fulfillment_name = $fulfillment_name;
    }

    function setFulfillment_id($fulfillment_id) {
        $this->fulfillment_id = $fulfillment_id;
    }

    function setTag_name($tag_name) {
        $this->tag_name = $tag_name;
    }

    function setFolder_id($folder_id) {
        $this->folder_id = $folder_id;
    }

    function setDate_added($date_added) {
        $this->date_added = $date_added;
    }

    function setDate_updated($date_updated) {
        $this->date_updated = $date_updated;
    }

    function getShipping_id() {
        return $this->shipping_id;
    }

    function setShipping_id($shipping_id) {
        $this->shipping_id = $shipping_id;
    }

}
