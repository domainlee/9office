<?php 
namespace Admin\Model;

use Base\Model\Base;

class OrderManufacture extends Base{
	
	protected $id;
    protected $orderId;
    protected $productId;
    protected $status;

	protected $quantity;
	protected $price;
	protected $intoMoney;

	protected $createdDateTime;
	protected $createdById;

	protected $startDateTime;
	protected $endDateTime;

    const IN_PRODUCTION = 1;
    const FINISHED_PRODUCTION = 2;

    protected $statuses = array(
        \Admin\Model\OrderManufacture::IN_PRODUCTION => 'Đang sản xuất',
        \Admin\Model\OrderManufacture::FINISHED_PRODUCTION => 'Sản xuất hoàn thành'
    );

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIntoMoney()
    {
        return $this->intoMoney;
    }

    /**
     * @param mixed $intoMoney
     */
    public function setIntoMoney($intoMoney)
    {
        $this->intoMoney = $intoMoney;
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
    public function getCreatedById()
    {
        return $this->createdById;
    }

    /**
     * @param mixed $createdById
     */
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;
    }

    /**
     * @return mixed
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * @param mixed $startDateTime
     */
    public function setStartDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return mixed
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * @param mixed $endDateTime
     */
    public function setEndDateTime($endDateTime)
    {
        $this->endDateTime = $endDateTime;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }


    public function toFormValues()
    {
        $data =  array(
            'orderId' => $this->getOrderId(),
            'status' => $this->getStatus(),
            'quantity'=> $this->getQuantity(),
            'price' => $this->getPrice(),
            'intoMoney'=> $this->getIntoMoney(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'createdById' => $this->getCreatedById(),
            'startDateTime' => $this->getStartDateTime(),
            'endDateTime' => $this->getEndDateTime(),
            'productId' => $this->getProductId(),
        );
        return $data;
    }


}














