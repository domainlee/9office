<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Page extends Base{

 	protected $id;
 	protected $storeId;
 	protected $name;
 	protected $description;
 	protected $createdDateTime;
    protected $status;
    protected $createdById;
    protected $childs;
    protected $childIds;
    protected $metaTitle;
    protected $metaKeyword;
    protected $metaDescription;
    protected $image;
    protected $url;
    protected $pageTemplate;
    protected $extraContent;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

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
    /**
     * @return mixed
     */
    public function getPageTemplate()
    {
        return $this->pageTemplate;
    }

    /**
     * @param mixed $pageTemplate
     */
    public function setPageTemplate($pageTemplate)
    {
        $this->pageTemplate = $pageTemplate;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

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
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param mixed $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return mixed
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * @param mixed $metaKeyword
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
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

    public function getChilds() {
        return $this->childs;
    }

    public function getViewLink() {
        return \Base\Model\Uri::slugify($this);
    }

    public function getViewUrl() {
        return !empty($this->getUrl()) ? '/'.$this->getUrl().'.html':null;
    }

    /**
     * @param field_type $childs
     */
    public function setChilds($childs) {
        $this->childs = $childs;
    }

    public function addChild($child){
        $this->childs[] = $child;
    }

    public function getChildIds($categories = null, &$cIds = null)
    {
        if (!$categories) {
            return $this->childIds;
        }
        if ($cIds == null) {
            $cIds = [];
        }
        if (count($categories)) {
            foreach ($categories as $c) {
                $cIds[] = $c->getId();
                if ($c->getChilds()) {
                    $this->getChildIds($c->getChilds(), $cIds);
                }
            }
        }
        return $cIds;
    }

    public function toFormValues()
    {
        $data =  array(
            'storeId' => $this->getStoreId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'createdById' => $this->getCreatedById(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'status' => $this->getStatus(),
            'metaTitle' => $this->getMetaTitle(),
            'metaKeyword' => $this->getMetaKeyword(),
            'metaDescription' => $this->getMetaDescription(),
            'url' => $this->getUrl(),
            'pageTemplate' => $this->getPageTemplate(),
            'extraContent' => $this->getExtraContent(),
        );

        return $data;
    }


}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 