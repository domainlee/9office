<?php
namespace Admin\Model;
use Base\Model\Base;

class AttrList extends Base{

    protected $productattrId;
    protected $productId;
    protected $storeId;

    const COLOR = 1;
    const SIZE = 2;
    const MATERIAL = 3;

    protected $type;

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
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productattrId
     */
    public function setProductattrId($productattrId)
    {
        $this->productattrId = $productattrId;
    }

    /**
     * @return mixed
     */
    public function getProductattrId()
    {
        return $this->productattrId;
    }


}
