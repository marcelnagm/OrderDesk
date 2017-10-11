<?php

namespace src;

/**
 * @Entity @Table(name="customerorders") @Entity(repositoryClass="OrderRepository")
 * */
class CustomerOrders {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @Column(type="string") * */
    private $source_id;

    /** @Column(type="integer")
     * @OneToOne(targetEntity="\src\Order")
     * @JoinColumn(name="order_id", referencedColumnName="order_id")     
     * * */
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
    private $quantity;

    /** @Column(type="string") * */
    private $BTCValue = 0;

    /** @Column(type="string") * */
    private $ETHValue = 0;

    /** @Column(type="string") * */
    private $Top1 = 0;

    /** @Column(type="string") * */
    private $Top2 = 0;

    /** @Column(type="string") * */
    private $Top3 = 0;

    /** @Column(type="string") * */
    private $Top4 = 0;

    /** @Column(type="string") * */
    private $Top5 = 0;

    /** @Column(type="string") * */
    private $Vision1 = 0;

    /** @Column(type="string") * */
    private $Vision2 = 0;

    /** @Column(type="string") * */
    private $Vision3 = 0;

    /** @Column(type="string") * */
    private $Vision4 = 0;

    /** @Column(type="string") * */
    private $Vision5 = 0;

    /** @Column(type="string") * */
    private $Vision6 = 0;

    /** @Column(type="string") * */
    private $Top1Description = "";

    /** @Column(type="string") * */
    private $Top2Description = "";

    /** @Column(type="string") * */
    private $Top3Description = "";

    /** @Column(type="string") * */
    private $Top4Description = "";

    /** @Column(type="string") * */
    private $Top5Description = "";

    /** @Column(type="string") * */
    private $Vision1Description = "";

    /** @Column(type="string") * */
    private $Vision2Description = "";

    /** @Column(type="string") * */
    private $Vision3Description = "";

    /** @Column(type="string") * */
    private $Vision4Description = "";

    /** @Column(type="string") * */
    private $Vision5Description = "";

    /** @Column(type="string") * */
    private $Vision6Description = "";

    /** @Column(type="string") * */
    private $DatePurchased;

    /** @Column(type="string") * */
    private $CurrentBTCValue = 0;

    /** @Column(type="string") * */
    private $CurrentETHValue = 0;

    /** @Column(type="string") * */
    private $CurrentTop1 = 0;

    /** @Column(type="string") * */
    private $CurrentTop2 = 0;

    /** @Column(type="string") * */
    private $CurrentTop3 = 0;

    /** @Column(type="string") * */
    private $CurrentTop4 = 0;

    /** @Column(type="string") * */
    private $CurrentTop5 = 0;

    /** @Column(type="string") * */
    private $CurrentVision1 = 0;

    /** @Column(type="string") * */
    private $CurrentVision2 = 0;

    /** @Column(type="string") * */
    private $CurrentVision3 = 0;

    /** @Column(type="string") * */
    private $CurrentVision4 = 0;

    /** @Column(type="string") * */
    private $CurrentVision5 = 0;

    /** @Column(type="string") * */
    private $CurrentVision6 = 0;

    /** @Column(type="string") * */
    private $Exchange = 0;

    /** @Column(type="string") * */
    private $Traded = 0;

    /** @Column(type="string") * */
    private $ExternalOrderID = "";

    /** @Column(type="string") * */
    private $CheckAmountAvailable = 0;

    /** @Column(type="string") * */
    private $CurrentDate;

    /** @Column(type="string") * */
    private $TrackingNumber;

    /** @Column(type="string") * */
    private $Country;

    /** @Column(type="string") * */
    private $Title;

    /** @Column(type="string") * */
    private $SKUDescription;

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
        $this->setCurrentDate($CurrentDate);
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
        $this->setCurrentDate($CurrentDate);
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

    function getTop1Description() {
        return $this->Top1Description;
    }

    function getTop2Description() {
        return $this->Top2Description;
    }

    function getTop3Description() {
        return $this->Top3Description;
    }

    function getTop4Description() {
        return $this->Top4Description;
    }

    function getTop5Description() {
        return $this->Top5Description;
    }

    function getVision1Description() {
        return $this->Vision1Description;
    }

    function getVision2Description() {
        return $this->Vision2Description;
    }

    function getVision3Description() {
        return $this->Vision3Description;
    }

    function getVision4Description() {
        return $this->Vision4Description;
    }

    function getVision5Description() {
        return $this->Vision5Description;
    }

    function setTop1Description($Top1Description) {
        $this->Top1Description = $Top1Description;
    }

    function setTop2Description($Top2Description) {
        $this->Top2Description = $Top2Description;
    }

    function setTop3Description($Top3Description) {
        $this->Top3Description = $Top3Description;
    }

    function setTop4Description($Top4Description) {
        $this->Top4Description = $Top4Description;
    }

    function setTop5Description($Top5Description5) {
        $this->Top5Description = $Top5Description5;
    }

    function setVision1Description($Vision1Description) {
        $this->Vision1Description = $Vision1Description;
    }

    function setVision2Description($Vision2Description) {
        $this->Vision2Description = $Vision2Description;
    }

    function setVision3Description($Vision3Description) {
        $this->Vision3Description = $Vision3Description;
    }

    function setVision4Description($Vision4Description) {
        $this->Vision4Description = $Vision4Description;
    }

    function setVision5Description($Vision5Description) {
        $this->Vision5Description = $Vision5Description;
    }

    function getVision6Description() {
        return $this->Vision6Description;
    }

    function setVision6Description($Vision6Description) {
        $this->Vision6Description = $Vision6Description;
    }

    function getDatePurchased() {
        return $this->DatePurchased;
    }

    function setDatePurchased($DatePurchased) {
        $this->DatePurchased = $DatePurchased;
//        $this->DatePurchased = date_format($DatePurchased, 'Y-m-d');
    }

    function getCurrentBTCValue() {
        return $this->CurrentBTCValue;
    }

    function getCurrentETHValue() {
        return $this->CurrentETHValue;
    }

    function getCurrentTop1() {
        return $this->CurrentTop1;
    }

    function getCurrentTop2() {
        return $this->CurrentTop2;
    }

    function getCurrentTop3() {
        return $this->CurrentTop3;
    }

    function getCurrentTop4() {
        return $this->CurrentTop4;
    }

    function getCurrentTop5() {
        return $this->CurrentTop5;
    }

    function getCurrentVision1() {
        return $this->CurrentVision1;
    }

    function getCurrentVision2() {
        return $this->CurrentVision2;
    }

    function getCurrentVision3() {
        return $this->CurrentVision3;
    }

    function getCurrentVision4() {
        return $this->CurrentVision4;
    }

    function getCurrentVision5() {
        return $this->CurrentVision5;
    }

    function getCurrentVision6() {
        return $this->CurrentVision6;
    }

    function getExchange() {
        return $this->Exchange;
    }

    function getTraded() {
        return $this->Traded;
    }

    function getExternalOrderID() {
        return $this->ExternalOrderID;
    }

    function getCheckAmountAvailable() {
        return $this->CheckAmountAvailable;
    }

    function setCurrentBTCValue($CurrentBTCValue) {
        $this->CurrentBTCValue = $CurrentBTCValue;
    }

    function setCurrentETHValue($CurrentETHValue) {
        $this->CurrentETHValue = $CurrentETHValue;
    }

    function setCurrentTop1($CurrentTop1) {
        $this->CurrentTop1 = $CurrentTop1;
    }

    function setCurrentTop2($CurrentTop2) {
        $this->CurrentTop2 = $CurrentTop2;
    }

    function setCurrentTop3($CurrentTop3) {
        $this->CurrentTop3 = $CurrentTop3;
    }

    function setCurrentTop4($CurrentTop4) {
        $this->CurrentTop4 = $CurrentTop4;
    }

    function setCurrentTop5($CurrentTop5) {
        $this->CurrentTop5 = $CurrentTop5;
    }

    function setCurrentVision1($CurrentVision1) {
        $this->CurrentVision1 = $CurrentVision1;
    }

    function setCurrentVision2($CurrentVision2) {
        $this->CurrentVision2 = $CurrentVision2;
    }

    function setCurrentVision3($CurrentVision3) {
        $this->CurrentVision3 = $CurrentVision3;
    }

    function setCurrentVision4($CurrentVision4) {
        $this->CurrentVision4 = $CurrentVision4;
    }

    function setCurrentVision5($CurrentVision5) {
        $this->CurrentVision5 = $CurrentVision5;
    }

    function setCurrentVision6($CurrentVision6) {
        $this->CurrentVision6 = $CurrentVision6;
    }

    function setExchange($Exchange) {
        $this->Exchange = $Exchange;
    }

    function setTraded($Traded) {
        $this->Traded = $Traded;
    }

    function setExternalOrderID($ExternalOrderID) {
        $this->ExternalOrderID = $ExternalOrderID;
    }

    function setCheckAmountAvailable($CheckAmountAvailable) {
        $this->CheckAmountAvailable = $CheckAmountAvailable;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function getCurrentDate() {
        return $this->CurrentDate;
    }

    function getTrackingNumber() {
        return $this->TrackingNumber;
    }

    function getCountry() {
        return $this->Country;
    }

    function setCurrentDate($CurrentDate) {
        $this->CurrentDate = gmdate('Y-m-d', time());
    }

    function setTrackingNumber($TrackingNumber) {
        $this->TrackingNumber = $TrackingNumber;
    }

    function setCountry($Country) {
        $this->Country = $Country;
    }

    function getTitle() {
        return $this->Title;
    }

    function getSKUDescription() {
        return $this->SKUDescription;
    }

    function setTitle($Title) {
        $this->Title = $Title;
    }

    function setSKUDescription($SKUDescription) {
        $this->SKUDescription = $SKUDescription;
    }

}
