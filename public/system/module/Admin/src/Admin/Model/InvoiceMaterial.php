<?php 
namespace Admin\Model;

use Base\Model\Base;

class InvoiceMaterial extends Base{
	
	protected $id;
	protected $type;
    protected $invoiceId;

	protected $materialId;
	protected $quantity;
	protected $price;
	protected $intoMoney;

	protected $inventoryTotalQuantiy;
	protected $inventoryPrice;
	protected $inventoryTotalPrice;
	protected $createdDateTime;
	protected $createdById;
	protected $orderId;
	protected $status;

    const STATUS_APPROVED = 1;
    const STATUS_NOT_APPROVED = 2;

    protected $statuses = array(
        \Admin\Model\Invoice::STATUS_APPROVED => 'Đã duyệt',
        \Admin\Model\Invoice::STATUS_NOT_APPROVED => 'Chưa duyệt'
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMaterialId()
    {
        return $this->materialId;
    }

    /**
     * @param mixed $materialId
     */
    public function setMaterialId($materialId)
    {
        $this->materialId = $materialId;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param mixed $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
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
    public function getInventoryTotalQuantiy()
    {
        return $this->inventoryTotalQuantiy;
    }

    /**
     * @param mixed $inventoryTotalQuantiy
     */
    public function setInventoryTotalQuantiy($inventoryTotalQuantiy)
    {
        $this->inventoryTotalQuantiy = $inventoryTotalQuantiy;
    }

    /**
     * @return mixed
     */
    public function getInventoryPrice()
    {
        return $this->inventoryPrice;
    }

    /**
     * @param mixed $inventoryPrice
     */
    public function setInventoryPrice($inventoryPrice)
    {
        $this->inventoryPrice = $inventoryPrice;
    }

    /**
     * @return mixed
     */
    public function getInventoryTotalPrice()
    {
        return $this->inventoryTotalPrice;
    }

    /**
     * @param mixed $inventoryTotalPrice
     */
    public function setInventoryTotalPrice($inventoryTotalPrice)
    {
        $this->inventoryTotalPrice = $inventoryTotalPrice;
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


    public function toFormValues()
    {
        $data =  array(
            'type' => $this->getType(),
            'materialId' => $this->getMaterialId(),
            'invoiceId' =>$this->getInvoiceId(),
            'quantity'=> $this->getQuantity(),
            'price' => $this->getPrice(),
            'intoMoney'=> $this->getIntoMoney(),
            'inventoryTotalQuantiy'=> $this->getInventoryTotalQuantiy(),
            'inventoryPrice' => $this->getInventoryPrice(),
            'inventoryTotalPrice' => $this->getInventoryTotalPrice(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'createdById' => $this->getCreatedById(),
            'orderId' => $this->getOrderId(),
            'status' => $this->getStatus()
        );
        return $data;
    }


}














