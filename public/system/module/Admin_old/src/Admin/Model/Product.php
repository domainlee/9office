<?php
namespace Admin\Model;
use \Base\Model\Base;
 
class Product extends Base{
 	protected $id;
 	protected $title;
 	protected $price;
    protected $priceOld;
    protected $cateName;
 	protected $categoryId;
 	protected $image;
 	protected $status;
// 	protected $childs;
 	protected $intro;
    protected $content;
 	protected $quantity;
 	protected $code;
 	protected $storeId;
    protected $createdById;
    protected $createdDateTime;
    protected $parentId;
    protected $brandId;
    protected $type;
    protected $tags;
    protected $metaTitle;
    protected $metaKeyword;
    protected $metaDescription;
    protected $viewLink;
    protected $productRelated;
    protected $articleRelated;
    protected $view;
    protected $url;
    protected $extraContent;

    const STATUS_ACTIVE = 1;
 	const STATUS_INACTIVE = 0;
 	const SELECT_MODE_ALL 	= 1;
	const SELECT_MODE_LEAF 	= 2;
	const SELECT_MODE_JSON 	= 3;
    const SELECT_MODE_NORMAL = 4;

    const PRODUCT_HOT = 1;
    const PRODUCT_VIEW = 2;
    const PRODUCT_ALL = 5;

 	protected $statuses = array(
 		\Admin\Model\Product::STATUS_ACTIVE => 'Hoạt động',
 		\Admin\Model\Product::STATUS_INACTIVE => 'Không hoạt động',
 	);

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
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
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
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
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
     * @param mixed $brandId
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param mixed $description
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $priceOld
     */
    public function setPriceOld($priceOld)
    {
        $this->priceOld = $priceOld;
    }

    /**
     * @return mixed
     */
    public function getPriceOld()
    {
        return $this->priceOld;
    }


	/**
	 * @return the $storeId
	 */
	public function getStoreId() {
		return $this->storeId;
	}

	/**
	 * @param field_type $storeId
	 */
	public function setStoreId($storeId) {
		$this->storeId = $storeId;
	}

	public function getStatuses() {
 		return $this->statuses;
 	}
 	//
 	public function setCategoryId($categoryId){
 		return $this->categoryId = $categoryId;
 	}
 	public function getCategoryId(){
 		return $this->categoryId;
 	}
 	//

 	public function setCateName($cateName){
 		return $this->cateName = $cateName;
 	}
 	public function getCateName(){
 		return $this->cateName;
 	}

 	public function setId($id){
 		return $this->id = $id;
 	}

 	public function getId(){
 		return $this->id;
 	}
 	//
 	public function setTitle($title){
 		return $this->title = $title;
 	}
 	public function getTitle(){
 		return $this->title;
 	}
 	//
 	public function setPrice($price){
 		return $this->price = $price;
 	}
 	public function getPrice(){
 		return $this->price;
 	}
 	//
	public function getImage() {
		return $this->image;
	}
	public function setImage($image) {
		$this->image = $image;
		return $this;
	}
 	//
// 	public function getChilds() {
// 		return $this->childs;
// 	}
//
// 	/**
// 	 * @param field_type $childs
// 	 */
// 	public function setChilds($childs) {
// 		$this->childs = $childs;
// 	}
 	//
 	//
 	public function getIntro() {
 		return $this->intro;
 	}
 	public function setIntro($intro) {
 		$this->intro = $intro;
 		return $this;
 	}
 	//
 	public function getCode() {
 		return $this->code;
 	}
 	public function setCode($code) {
 		$this->code = $code;
 		return $this;
 	}
 	//
 	public function getQuantity() {
 		return $this->quantity;
 	}
 	public function setQuantity($quantity) {
 		$this->quantity = $quantity;
 		return $this;
 	}
 	//
 	//
 	public function setStatus($status){
 		return $this->status = $status;
 	}
 	public function getStatus(){
 		return $this->status;
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
    public function getCreatedById()
    {
        return $this->createdById;
    }

    /**
     * @param mixed $createdDateTime
     */
    public function setCreatedDateTime($createdDateTime)
    {
        $this->createdDateTime = $createdDateTime;
    }

    /**
     * @return mixed
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

 	public function setCategoryIds($arr){
 		if (!!($element = $this->get('categoryId'))){
 			$element->setValueOptions(array(''=>'- Tên thể loại -') + $arr);
 		}
 	}
 	public function setColorIds($arr){
 		if(!!($element = $this->get('colorId'))){
 			$element->setValueOptions(array(''=>'- Màu sắc -')+$arr);
 		}
 	}

    public function getViewLink(){
        return !empty($this->getUrl()) ? '/'.$this->getUrl().'.html':\Base\Model\Uri::slugify($this);
    }

//    public function getViewUrl() {
//        return !empty($this->getUrl()) ? '/'.$this->getUrl().'.html':null;
//    }

// 	public function exchangeArray($data){
// 		parent::exchangeArray($data);
// 		$parent = new \Admin\Model\Product();
// 		if(isset($data['cateName'])){
// 			$parent->setName($data['cateName']);
// 			$parent->setCateName($parent);
// 		}
// 		if(isset($data['colorName'])){
// 			$parent->setName($data['colorName']);
// 			$parent->setColorName($parent);
// 		}
// 	}
 	public function toSelectboxArray($items, $selectMode = \Admin\Model\Product::SELECT_MODE_ALL) {
 		if(is_array($items) && count($items)) {
 			/* @var $item \Product\Model\AProductc */
 			return $this->buildSelectBox(null, $this->buildTree($items), $selectMode);
 		}
 		return array();
 	}

    public function attr(){

    }
 	
 	/**
 	 * @param array $result
 	 */
 	public function buildSelectBox($result, $items, $selectMode, $level = 0) {
 		if(!$result) {
 			$result = array();
 		}
 	
 		if(count($items)) {
 			foreach ($items as $item) {
 				/* @var $item \Product\Model\AProductc */
 				if($selectMode == \Admin\Model\Product::SELECT_MODE_LEAF) {
 					if(count($item->getChilds())) {
 						$result[$item->getName()] = $this->buildSelectBox(null, $item->getChilds(), $selectMode);
 					} else {
 						$result[$item->getId()] = html_entity_decode($item->getName());
 					}
 				} else if ($selectMode == \Admin\Model\Product::SELECT_MODE_ALL) {
 					$sign = str_repeat(" - ", $level*3);
 					$result[$item->getId()] = $sign . html_entity_decode($item->getName());
 					// array passed by value. change buildSelectBox(&$result) to pass by reference
 					$result += $this->buildSelectBox(null, $item->getChilds(), $selectMode, ++$level);
 				} else if ($selectMode == \Admin\Model\Product::SELECT_MODE_NORMAL) {
 					$result[$item->getId()] = html_entity_decode($item->getName());
 					$result += $this->buildSelectBox(null, $item->getChilds(), $selectMode, ++$level);
 				} else {
 					$sign = str_repeat(" - ", $level*3);
 					$result[] = array('id' => $item->getId(), 'label' => $sign . html_entity_decode($item->getName()));
 					// array passed by value. change buildSelectBox(&$result) to pass by reference
 					$result = array_merge($result, $this->buildSelectBox(null, $item->getChilds(), $selectMode, ++$level));
 				}
 				$level--;
 			}
 		}
 		return $result;
 	}
 	/**
 	 * build select box
 	 * @param array $items
 	 */
 	public function buildTree($items) {
 		$result = array();
 		$tmp = array();
 		$ids = array();
 		foreach($items as $item) {
 			/* @var $item \Product\Model\Category */
 			$ids[] = $item->getId();
 			$result[$item->getId()] = $item;
 			$tmp[$item->getId()] = $item;
 		}
 	
 		foreach($result as $item) {
 			if($item->getParentId() && in_array($item->getParentId(), $ids)) {
 				/* @var $d \Product\Model\Category */
 				$d = $tmp[$item->getParentId()];
 				$d->addChild($item);
 				unset($result[$item->getId()]);
 			}
 		}
 		return $result;
 	}
 	
 	public function addChild($child) {
 		if(!is_array($this->childs)) {
 			$this->childs = array();
 		}
 		$this->childs[] = $child;
 	}

    public function toFormValues($serviceLocator = null){
        $data = [
            'id' => $this->getId(),
            'categoryId' => $this->getCategoryId(),
            'storeId' => $this->getStoreId(),
            'parentId' => $this->getParentId(),
            'brandId' => $this->getBrandId(),
            'title' => html_entity_decode($this->getTitle()),
            'code' => $this->getCode(),
            'image' => $this->getImage(),
            'intro' => html_entity_decode($this->getIntro()),
            'content' => $this->getContent(),
            'price' => $this->getPrice(),
            'priceOld' => $this->getPriceOld(),
            'quantity' => $this->getQuantity(),
            'status' => $this->getStatus(),
            'createdById' => $this->getCreatedById(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'type' => $this->getType(),
            'tags' => $this->getTags(),
            'metaTitle' => $this->getMetaTitle(),
            'metaKeyword' => $this->getMetaKeyword(),
            'metaDescription' => $this->getMetaDescription(),
            'extraContent' => $this->getExtraContent(),
            'view' => $this->getView(),
            'url' => $this->getUrl(),
        ];

        return $data;
    }

    public function fetchAllProduct($a = null)
    {
        if(count($a)){
            $c = [];
            foreach($a as $b){
                $c[$b->getId()] = $b->getTitle();
            }
            return $c;
        }
        return [];
    }

}