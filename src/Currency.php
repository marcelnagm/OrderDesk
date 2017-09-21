<?php

namespace src;

/**
 * @Entity @Table(name="visionary") @Entity(repositoryClass="OrderRepository")
 * */
class Currency {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @Column(type="string") * */
    private $id_cap;

    /** @Column(type="string") * */
    private $name;

    /** @Column(type="string") * */
    private $symbol;

    /** @Column(type="integer") * */
    private $rank;

    /** @Column(type="string") * */
    private $price_usd;

    /** @Column(type="string") * */
    private $price_btc;

    /** @Column(type="string") * */
    private $h24_volume_usd;

    /** @Column(type="string") * */
    private $market_cap_usd;

    /** @Column(type="string") * */
    private $available_supply;
    
    /** @Column(type="string") * */
    private $h24_volume_cad;

    /** @Column(type="string") * */
    private $market_cap_cad;

    /** @Column(type="string") * */
    private $price_cad;

    /** @Column(type="string") * */
    private $total_supply;

    /** @Column(type="string") * */
    private $percent_change_1h;

    /** @Column(type="string") * */
    private $percent_change_7d;

    /** @Column(type="string") * */
    private $percent_change_24h;

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

    function getId_cap() {
        return $this->id_cap;
    }

    function getName() {
        return $this->name;
    }

    function getSymbol() {
        return $this->symbol;
    }

    function getRank() {
        return $this->rank;
    }

    function getPrice_usd() {
        return $this->price_usd;
    }

    function getPrice_btc() {
        return $this->price_btc;
    }

    function getH24_volume_usd() {
        return $this->h24_volume_usd;
    }

    function getMarket_cap_usd() {
        return $this->market_cap_usd;
    }

    function getAvailable_supply() {
        return $this->available_supply;
    }

    function getTotal_supply() {
        return $this->total_supply;
    }

    function getPercent_change_1h() {
        return $this->percent_change_1h;
    }

    function setId_cap($id_cap) {
        $this->id_cap = $id_cap;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSymbol($symbol) {
        $this->symbol = $symbol;
    }

    function setRank($rank) {
        $this->rank = $rank;
    }

    function setPrice_usd($price_usd) {
        $this->price_usd = $price_usd;
    }

    function setPrice_btc($price_btc) {
        $this->price_btc = $price_btc;
    }

    function setH24_volume_usd($h24_volume_usd) {
        $this->h24_volume_usd = $h24_volume_usd;
    }

    function setMarket_cap_usd($market_cap_usd) {
        $this->market_cap_usd = $market_cap_usd;
    }

    function setAvailable_supply($available_supply) {
        $this->available_supply = $available_supply;
    }

    function setTotal_supply($total_supply) {
        $this->total_supply = $total_supply;
    }

    function setPercent_change_1h($percent_change_1h) {
        $this->percent_change_1h = $percent_change_1h;
    }

    function getPercent_change_7d() {
        return $this->percent_change_7d;
    }

    function setPercent_change_7d($percent_change_7d) {
        $this->percent_change_7d = $percent_change_7d;        
    }

    function getPercent_change_24h() {
        return $this->percent_change_24h;
    }

    function setPercent_change_24h($percent_change_24h) {
        $this->percent_change_24h = $percent_change_24h;
    }

    function getH24_volume_cad() {
        return $this->h24_volume_cad;
    }

    function getMarket_cap_cad() {
        return $this->market_cap_cad;
    }

    function getPrice_cad() {
        return $this->price_cad;
    }

    function setH24_volume_cad($h24_volume_cad) {
        $this->h24_volume_cad = $h24_volume_cad;
    }

    function setMarket_cap_cad($market_cap_cad) {
        $this->market_cap_cad = $market_cap_cad;
    }

    function setPrice_cad($price_cad) {
        $this->price_cad = $price_cad;
    }


    
}
