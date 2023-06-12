<?php 
namespace Admin\Model;

use Base\Model\Base;

class Invoice extends Base{
	
	protected $id;
	protected $type;
    protected $status;
    protected $description;
	protected $createdDateTime;
	protected $updatedDateTime;
	protected $createdById;
	protected $approvedById;
	protected $orderId;
	protected $productId;

	const STATUS_APPROVED = 1;
 	const STATUS_NOT_APPROVED = 2;

 	const IMPORT = 1;
 	const EXPORT = 2;

    public $statuses = array(
		\Admin\Model\Invoice::STATUS_APPROVED => 'Đã duyệt',
		\Admin\Model\Invoice::STATUS_NOT_APPROVED => 'Chưa duyệt'
	);

    public $type_invoice = array(
        \Admin\Model\Invoice::IMPORT => 'Nhập',
        \Admin\Model\Invoice::EXPORT => 'Xuất',
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getUpdatedDateTime()
    {
        return $this->updatedDateTime;
    }

    /**
     * @param mixed $updatedDateTime
     */
    public function setUpdatedDateTime($updatedDateTime)
    {
        $this->updatedDateTime = $updatedDateTime;
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
    public function getApprovedById()
    {
        return $this->approvedById;
    }

    /**
     * @param mixed $approvedById
     */
    public function setApprovedById($approvedById)
    {
        $this->approvedById = $approvedById;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
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


    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function toFormValues()
    {
        $data =  array(
            'type' => $this->getType(),
            'status' => $this->getStatus(),
            'description' => $this->getDescription(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'updatedDateTime' => $this->getUpdatedDateTime(),
            'createdById' => $this->getCreatedById(),
            'approvedById' => $this->getApprovedById(),
            'orderId' => $this->getOrderId(),
            'productId' => $this->getProductId(),
        );
        return $data;
    }


}














