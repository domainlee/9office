<?php
namespace Admin\Model;

use Base\Model\Base;
class Order extends Base{
	protected $id;
	protected $storeId;
	protected $shippingType;
	protected $customerName;
	protected $customerAddress;
	protected $customerMobile;
	protected $customerEmail;
	protected $description;
	protected $createdbyId;
	protected $createdDateTime;
	protected $confirmedDateTime;
	protected $status;
	protected $totalMoney;
	protected $orderProduct;
	protected $quantity;
	protected $product;
	protected $clientId;
	protected $methodPay;
	protected $orderId;


    const STATUS_NEW = 1;
    const STATUS_DONE = 2;

    const PAYMENT_DIRECT = 1;
    const PAYMENT_COD = 2;

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
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getMethodPay()
    {
        return $this->methodPay;
    }

    /**
     * @param mixed $methodPay
     */
    public function setMethodPay($methodPay)
    {
        $this->methodPay = $methodPay;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

	/**
	 * @return the $quantity
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @param field_type $quantity
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}

	/**
	 * @return the $orderProduct
	 */
	public function getOrderProduct() {
		return $this->orderProduct;
	}

	/**
	 * @param field_type $orderProduct
	 */
	public function setOrderProduct($orderProduct) {
		$this->orderProduct = $orderProduct;
	}	

	/**
	 * @return the $totalMoney
	 */
	public function getTotalMoney() {
		return $this->totalMoney;
	}

	/**
	 * @param Ambigous <unknown, number> $totalMoney
	 */
	public function setTotalMoney($totalMoney) {
		$this->totalMoney = $totalMoney;
	}

	public function addProduct($product) {
		if(!is_array($this->orderProduct)) {
			$this->orderProduct = array();
		}
		$this->orderProduct[] = $product;
	}
	
	public function addMoney($money) {
		$this->totalMoney = $this->totalMoney?: 0;
		$this->totalMoney += $money;
	}
	public function qtt($quantity){
		$this->quantity = $this->quantity?: 0;
		$this->quantity = $quantity;
	}
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $storeId
	 */
	public function getStoreId() {
		return $this->storeId;
	}

	/**
	 * @param field_type $storeId
	 */
	public function setStoreId($storeId) {
		$this->storeId = $storeId;
	}

	/**
	 * @return the $shippingType
	 */
	public function getShippingType() {
		return $this->shippingType;
	}

	/**
	 * @param field_type $shippingType
	 */
	public function setShippingType($shippingType) {
		$this->shippingType = $shippingType;
	}

	/**
	 * @return the $customerName
	 */
	public function getCustomerName() {
		return $this->customerName;
	}

	/**
	 * @param field_type $customerName
	 */
	public function setCustomerName($customerName) {
		$this->customerName = $customerName;
	}

	/**
	 * @return the $customerAddress
	 */
	public function getCustomerAddress() {
		return $this->customerAddress;
	}

	/**
	 * @param field_type $customerAddress
	 */
	public function setCustomerAddress($customerAddress) {
		$this->customerAddress = $customerAddress;
	}

	/**
	 * @return the $customerMobile
	 */
	public function getCustomerMobile() {
		return $this->customerMobile;
	}

	/**
	 * @param field_type $customerMobile
	 */
	public function setCustomerMobile($customerMobile) {
		$this->customerMobile = $customerMobile;
	}

	/**
	 * @return the $customerEmail
	 */
	public function getCustomerEmail() {
		return $this->customerEmail;
	}

	/**
	 * @param field_type $customerEmail
	 */
	public function setCustomerEmail($customerEmail) {
		$this->customerEmail = $customerEmail;
	}

	/**
	 * @return the $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param field_type $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return the $createdbyId
	 */
	public function getCreatedbyId() {
		return $this->createdbyId;
	}

	/**
	 * @param field_type $createdbyId
	 */
	public function setCreatedbyId($createdbyId) {
		$this->createdbyId = $createdbyId;
	}

	/**
	 * @return the $createdDateTime
	 */
	public function getCreatedDateTime() {
		return $this->createdDateTime;
	}

	/**
	 * @param field_type $createdDateTime
	 */
	public function setCreatedDateTime($createdDateTime) {
		$this->createdDateTime = $createdDateTime;
	}

	/**
	 * @return the $confirmedDateTime
	 */
	public function getConfirmedDateTime() {
		return $this->confirmedDateTime;
	}

	/**
	 * @param field_type $confirmedDateTime
	 */
	public function setConfirmedDateTime($confirmedDateTime) {
		$this->confirmedDateTime = $confirmedDateTime;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param field_type $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}


}