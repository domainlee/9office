<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Option extends Base{

 	protected $id;
 	protected $storeId;
 	protected $data;
    protected $articleField;
    protected $productField;

    /**
     * @return mixed
     */
    public function getArticleField()
    {
        return $this->articleField;
    }

    /**
     * @param mixed $articleField
     */
    public function setArticleField($articleField)
    {
        $this->articleField = $articleField;
    }

    /**
     * @return mixed
     */
    public function getProductField()
    {
        return $this->productField;
    }

    /**
     * @param mixed $productField
     */
    public function setProductField($productField)
    {
        $this->productField = $productField;
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


    public function toFormValues()
    {
        $data =  array(
            'storeId' => $this->getStoreId(),
            'username' => $this->getUsername(),
            'data' => $this->getData(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 