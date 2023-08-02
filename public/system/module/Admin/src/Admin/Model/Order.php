<?php
namespace Admin\Model;

use Base\Model\Base;
class Order extends Base{

	protected $orderId;
	protected $depotId;
	protected $depotName;
	protected $customerMobile;
	protected $customerAddress;
    protected $customerName;
    protected $customerEmail;
	protected $statusName;
	protected $statusCode;
	protected $calcTotalMoney;
	protected $createdDateTime;
	protected $productCode;
	protected $productImage;
	protected $productName;
	protected $quantity;
	protected $stock;

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * @param mixed $productImage
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getDepotId()
    {
        return $this->depotId;
    }

    /**
     * @param mixed $depotId
     */
    public function setDepotId($depotId)
    {
        $this->depotId = $depotId;
    }

    /**
     * @return mixed
     */
    public function getDepotName()
    {
        return $this->depotName;
    }

    /**
     * @param mixed $depotName
     */
    public function setDepotName($depotName)
    {
        $this->depotName = $depotName;
    }

    /**
     * @return mixed
     */
    public function getCustomerMobile()
    {
        return $this->customerMobile;
    }

    /**
     * @param mixed $customerMobile
     */
    public function setCustomerMobile($customerMobile)
    {
        $this->customerMobile = $customerMobile;
    }

    /**
     * @return mixed
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * @param mixed $customerAddress
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @param mixed $customerEmail
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return mixed
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * @param mixed $statusName
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getCalcTotalMoney()
    {
        return $this->calcTotalMoney;
    }

    /**
     * @param mixed $calcTotalMoney
     */
    public function setCalcTotalMoney($calcTotalMoney)
    {
        $this->calcTotalMoney = $calcTotalMoney;
    }

    /**
     * @return mixed
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @param mixed $createdDateTime
     */
    public function setCreatedDateTime($createdDateTime)
    {
        $this->createdDateTime = $createdDateTime;
    }

    /**
     * @return mixed
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param mixed $productCode
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

}