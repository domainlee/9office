<?php
namespace Admin\Model;
use \Base\Model\Base;
 
class Comment extends Base{
 	protected $id;
 	protected $itemId;
 	protected $type;
 	protected $replyId;
 	protected $storeId;
    protected $title;
    protected $content;
 	protected $createdById;
 	protected $createdDateTime;
 	protected $status;
 	protected $extraContent;

    const PRODUCT = 1;
    const ARTICLE = 2;

    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

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
    public function getReplyId()
    {
        return $this->replyId;
    }

    /**
     * @param mixed $replyId
     */
    public function setReplyId($replyId)
    {
        $this->replyId = $replyId;
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
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
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
    public function getExtraContent()
    {
        return $this->extraContent;
    }

    /**
     * @param mixed $extraContent
     */
    public function setExtraContent($extraContent)
    {
        $this->extraContent = $extraContent;
    }


    public function toFormValues($serviceLocator = null){

        $data = [
            'id' => $this->getId(),
            'itemId' => $this->getItemId(),
            'type' => $this->getType(),
            'replyId' => $this->getReplyId(),
            'storeId' => $this->getStoreId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'createdById' => $this->getCreatedById(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'status' => $this->getStatus(),
            'extraContent' => $this->getExtraContent(),
        ];

        return $data;
    }

}