<?php
namespace Admin\Model;
use Base\Model\Base;
 
class MediaItem extends Base{

    protected $type;
    protected $fileItem;
    protected $itemId;
    protected $sort;
    protected $storeId;

    const FILE_ARTICLE = 1;
    const FILE_PRODUCT = 2;
    const FILE_CATEGORY_PRODUCT = 3;
    const FILE_BANNER = 4;
    const FILE_BRAND = 5;
    const FILE_PAGE = 6;
    const FILE_CATEGORY_ARTICLE = 7;


    protected $types = array(
        self::FILE_ARTICLE => 'Ảnh tin tức',
        self::FILE_PRODUCT => 'Ảnh sản phẩm',
        self::FILE_CATEGORY_PRODUCT => 'Ảnh danh mục',
        self::FILE_BANNER => 'Banner',
        self::FILE_BRAND => 'Thương hiệu',
        self::FILE_PAGE => 'Trang',
        self::FILE_CATEGORY_ARTICLE => 'Ảnh danh mục tin tức',
    );

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
     * @param mixed $fileItem
     */
    public function setFileItem($fileItem)
    {
        $this->fileItem = $fileItem;
    }

    /**
     * @return mixed
     */
    public function getFileItem()
    {
        return $this->fileItem;
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
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
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
    public function getType()
    {
        return $this->type;
    }


}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 