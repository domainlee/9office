<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Material extends Base{

 	protected $id;
 	protected $name;
 	protected $type;
    protected $totalQuantiy;
    protected $price;
    protected $totalPrice;
 	protected $manufactureId;
 	protected $createdById;
 	protected $image;
 	protected $createdDateTime;

 	protected $manufactureIds;

    public $type_form = array(
        '1' => 'Cái',
        '2' => 'KG (Kilogram)',
        '3' => 'Công',
        '4' => 'Chiếc',
        '5' => 'CM (Centimet)',
        '6' => 'Bộ',
        '7' => 'Con',
    );

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
    public function getManufactureIds()
    {
        return $this->manufactureIds;
    }

    /**
     * @param mixed $manufactureIds
     */
    public function setManufactureIds($manufactureIds)
    {
        $this->manufactureIds = $manufactureIds;
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
    public function getTotalQuantiy()
    {
        return $this->totalQuantiy;
    }

    /**
     * @param mixed $totalQuantiy
     */
    public function setTotalQuantiy($totalQuantiy)
    {
        $this->totalQuantiy = $totalQuantiy;
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
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
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

    public function nccs() {
        return '';
    }

    public function toFormValues()
    {


        $data =  array(
            'name' => $this->getName(),
            'type' => $this->getType(),
            'totalQuantiy' => $this->getTotalQuantiy(),
            'price' => $this->getPrice(),
            'totalPrice' => $this->getTotalPrice(),
            'manufactureId' => $this->getManufactureId(),
            'createdById' => $this->getCreatedById(),
            'image' => $this->getImage(),
            'createdDateTime' => $this->getCreatedDateTime(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 