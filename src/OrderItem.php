<?php

namespace src;

/**
 * @Entity @Table(name="orderitem") @Entity(repositoryClass="OrderRepository")
 * */
class OrderItem {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;
    /** @Column(type="string") * */
    private $item_id;
	    /** @Column(type="string") * */
    private $order_id;
    /** @Column(type="string") * */
    private $name;
	    /** @Column(type="string") * */
    private $quantity;
    /** @Column(type="string") * */
    private $weight;
	/** @Column(type="string") * */
    private $code;
	/** @Column(type="string") * */
    private $delivery_type;
	/** @Column(type="string") * */
    private $category_code;
	/** @Column(type="string") * */
    private $variation_list;
	/** @Column(type="string") * */
    private $metadata;
		public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getItem_id(){
		return $this->item_id;
	}

	public function setItem_id($item_id){
		$this->item_id = $item_id;
	}

	public function getOrder_id(){
		return $this->order_id;
	}

	public function setOrder_id($order_id){
		$this->order_id = $order_id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

	public function getWeight(){
		return $this->weight;
	}

	public function setWeight($weight){
		$this->weight = $weight;
	}

	public function getCode(){
		return $this->code;
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function getDelivery_type(){
		return $this->delivery_type;
	}

	public function setDelivery_type($delivery_type){
		$this->delivery_type = $delivery_type;
	}

	public function getCategory_code(){
		return $this->category_code;
	}

	public function setCategory_code($category_code){
		$this->category_code = $category_code;
	}

	public function getVariation_list(){
		return $this->variation_list;
	}

	public function setVariation_list($variation_list){
		$this->variation_list = json_encode($variation_list);
	}

	public function getMetadata(){
		return $this->metadata;
	}

	public function setMetadata($metadata){
		$this->metadata = json_encode($metadata);
	}
	

    public function __construct($array = null) {
        if (is_array($array)) {

            $fields = get_class_vars(__CLASS__);
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

	

}
