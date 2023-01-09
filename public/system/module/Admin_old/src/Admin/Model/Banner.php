<?php
namespace Admin\Model;
use \Base\Model\Base;

class Banner extends Base{
    protected $id;
    protected $name;
    protected $description;
    protected $status;
    protected $storeId;
    protected $createdById;
    protected $createdDateTime;
    protected $link;
    protected $productRelated;
    protected $articleRelated;
    protected $image;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getProductRelated()
    {
        return $this->productRelated;
    }

    /**
     * @param mixed $productRelated
     */
    public function setProductRelated($productRelated)
    {
        $this->productRelated = $productRelated;
    }

    /**
     * @return mixed
     */
    public function getArticleRelated()
    {
        return $this->articleRelated;
    }

    /**
     * @param mixed $articleRelated
     */
    public function setArticleRelated($articleRelated)
    {
        $this->articleRelated = $articleRelated;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }
    /**
     * @param mixed $createDateTime
     */
    public function setCreatedDateTime($createDateTime)
    {
        $this->createdDateTime = $createDateTime;
    }

    /**
     * @return mixed
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @param mixed $createdbyId
     */
    public function setCreatedById($createdbyId)
    {
        $this->createdById = $createdbyId;
    }

    /**
     * @return mixed
     */
    public function getCreatedById()
    {
        return $this->createdById;
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
    public function getDescription()
    {
        return $this->description;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $positionId
     */
    public function setPositionId($positionId)
    {
        $this->positionId = $positionId;
    }

    /**
     * @return mixed
     */
    public function getPositionId()
    {
        return $this->positionId;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param array $statuses
     */
    public function setStatuses($statuses)
    {
        $this->statuses = $statuses;
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return $this->statuses;
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
    public function getStoreId()
    {
        return $this->storeId;
    }

    public function toFormValues($serviceLocator = null){
        $data = [
            'id' => $this->getId(),
            'storeId' => $this->getStoreId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'link' => $this->getLink(),
            'status' => $this->getStatus(),
            'createdById' => $this->getCreatedbyId(),
            'createdDateTime' => $this->getCreatedDateTime()
        ];

        return $data;
    }

}
