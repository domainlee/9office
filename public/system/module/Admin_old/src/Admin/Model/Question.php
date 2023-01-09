<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Question extends Base{

 	protected $id;
    protected $storeId;
    protected $title;
    protected $content;
    protected $createdDateTime;
    protected $updateDateTime;
    protected $createdById;
    protected $assignId;
    protected $status;

    const STATUS_NEW = 1;
    const STATUS_ACCEPT = 2;
    const STATUS_WORKING = 3;
    const STATUS_DONE = 4;
    const STATUS_REWORK = 5;

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
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param mixed $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
    public function getUpdateDateTime()
    {
        return $this->updateDateTime;
    }

    /**
     * @param mixed $updateDateTime
     */
    public function setUpdateDateTime($updateDateTime)
    {
        $this->updateDateTime = $updateDateTime;
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
    public function getAssignId()
    {
        return $this->assignId;
    }

    /**
     * @param mixed $assignId
     */
    public function setAssignId($assignId)
    {
        $this->assignId = $assignId;
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
            'storeId' => $this->getStoreId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'createdById' => $this->getCreatedById(),
            'assignId' => $this->getAssignId(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'updateDateTime' => $this->getUpdateDateTime(),
            'status' => $this->getStatus(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 