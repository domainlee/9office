<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Menu extends Base{

    protected $id;
    protected $name;
    protected $nameKey;
    protected $storeId;
    protected $menu;

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
    public function getNameKey()
    {
        return $this->nameKey;
    }

    /**
     * @param mixed $nameKey
     */
    public function setNameKey($nameKey)
    {
        $this->nameKey = $nameKey;
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
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }


    public function toFormValues()
    {
        $data =  array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameKey' => $this->getNameKey(),
            'storeId' => $this->getStoreId(),
            'menu' => $this->getMenu(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 