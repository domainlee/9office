<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Material extends Base{

 	protected $id;
 	protected $name;
 	protected $depot;
 	protected $type;
 	protected $price;
 	protected $manufactureId;
 	protected $createdById;

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
    public function getDepot()
    {
        return $this->depot;
    }

    /**
     * @param mixed $depot
     */
    public function setDepot($depot)
    {
        $this->depot = $depot;
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
    public function getManufactureId()
    {
        return $this->manufactureId;
    }

    /**
     * @param mixed $manufactureId
     */
    public function setManufactureId($manufactureId)
    {
        $this->manufactureId = $manufactureId;
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


    public function toFormValues()
    {
        $data =  array(

        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 