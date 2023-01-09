<?php
namespace Admin\Model;
use Base\Model\Base;

class Attr extends Base{

    protected $id;
    protected $name;
    protected $colorCode;
    protected $storeId;
    protected $type;

    const COLOR = 1;
    const SIZE = 2;
    const MATERIAL = 3;

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
     * @param array $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getType()
    {
        return $this->type;
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
     * @param mixed $colorCode
     */
    public function setColorCode($colorCode)
    {
        $this->colorCode = $colorCode;
    }

    /**
     * @return mixed
     */
    public function getColorCode()
    {
        return $this->colorCode;
    }

    public function getMaterial() {
        return [1 => 'Màu sắc', 2 => 'Size', 3 => 'Chất liệu'];
    }


}
