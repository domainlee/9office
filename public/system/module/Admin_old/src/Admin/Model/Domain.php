<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Domain extends Base{

 	protected $id;
 	protected $storeId;
 	protected $uitemplateId;
 	protected $name;
 	protected $alias;
 	protected $description;
 	protected $optionPage;
 	protected $homePage;
    protected $uiName;
    protected $storeName;
    protected $createdDateTime;
    protected $parentStoreId;

    /**
     * @return mixed
     */
    public function getHomePage()
    {
        return $this->homePage;
    }

    /**
     * @param mixed $homePage
     */
    public function setHomePage($homePage)
    {
        $this->homePage = $homePage;
    }

    /**
     * @return mixed
     */
    public function getParentStoreId()
    {
        return $this->parentStoreId;
    }

    /**
     * @param mixed $parentStoreId
     */
    public function setParentStoreId($parentStoreId)
    {
        $this->parentStoreId = $parentStoreId;
    }

    /**
     * @return mixed
     */
    public function getUiName()
    {
        return $this->uiName;
    }

    /**
     * @param mixed $uiName
     */
    public function setUiName($uiName)
    {
        $this->uiName = $uiName;
    }

    /**
     * @return mixed
     */
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param mixed $storeName
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
    }

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
    public function getUitemplateId()
    {
        return $this->uitemplateId;
    }

    /**
     * @param mixed $uitemplateId
     */
    public function setUitemplateId($uitemplateId)
    {
        $this->uitemplateId = $uitemplateId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
    public function getOptionPage()
    {
        return $this->optionPage;
    }

    /**
     * @param mixed $optionPage
     */
    public function setOptionPage($optionPage)
    {
        $this->optionPage = $optionPage;
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



    public function toFormValues()
    {
        $data =  array(
            'storeId' => $this->getStoreId(),
            'uitemplateId' => $this->getUitemplateId(),
            'name' => $this->getName(),
            'alias' => $this->getAlias(),
            'description' => $this->getDescription(),
            'optionPage' => $this->getOptionPage(),
            'createdDateTime' => $this->getCreatedDateTime(),
        );

        return $data;
    }


}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 