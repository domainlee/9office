<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Article extends Base{
 	protected $id;
 	protected $title;
 	protected $categoryId;
 	protected $cateName;
 	protected $image;
 	protected $status;
 	protected $content;
 	protected $description;
 	protected $createdDateTime;
 	protected $storeId;
    protected $createdById;
    protected $type;
    protected $extraContent;
    protected $tags;
    protected $metaTitle;
    protected $metaKeyword;
    protected $metaDescription;
    protected $articleRelated;
    protected $url;

    const POSITION_ONE = 1;
    const POSITION_TWO = 2;
    const POSITION_THREE = 3;
    const POSITION_FOUR = 4;

    protected $view;

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

    public function getCateName()
    {
        return $this->cateName;
    }

    /**
     * @param mixed $cateName
     */
    public function setCateName($cateName)
    {
        $this->cateName = $cateName;
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
     * @param mixed $extraContent
     */
    public function setExtraContent($extraContent)
    {
        $this->extraContent = $extraContent;
    }

    /**
     * @return mixed
     */
    public function getExtraContent()
    {
        return $this->extraContent;
    }

    /**
     * @param array $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
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

 	const STATUS_ACTIVE = 1;
 	const STATUS_INACTIVE = 0;
 	const SELECT_MODE_ALL 	= 1;
	const SELECT_MODE_LEAF 	= 2;
	const SELECT_MODE_JSON 	= 3;
    const SELECT_MODE_NORMAL = 4;

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
 	public function getViewLink(){
 		return !empty($this->getUrl()) ? '/'.$this->getUrl().'.html':\Base\Model\Uri::slugify($this);
 	}

 	public function setId($id){
 		return $this->id = $id;
 	}
 	public function getId(){
 		return $this->id;
 	}

 	public function setContent($content){
 		return $this->content = $content;
 	}
 	public function getContent(){
 		return $this->content;
 	}

	public function getImage() {
		return $this->image;
	}

	public function setImage($image) {
		$this->image = $image;
		return $this;
	}

 	public function getTitle() {
 		return $this->title;
 	}

 	public function setTitle($title) {
 		$this->title = $title;
 		return $this;
 	}

 	public function getDescription() {
 		return $this->description;
 	}
 	public function setDescription($description) {
 		$this->description = $description;
 		return $this;
 	}

 	public function setStatus($status){
 		return $this->status = $status;
 	}

 	public function getStatus(){
 		return $this->status;
 	}
 	//
 	public function getCreatedDateTime(){
 		return $this->createdDateTime;
 	}
 	
 	/**
 	 * @param field_type $createdDateTime
 	 */
 	public function setCreatedDateTime($createdDateTime){
 		$this->createdDateTime = $createdDateTime;
 		return $this;
 	}
 	//
 	public function setCategoryIds($array){
 		if (!!($element = $this->get('categoryId'))){
 			$element->setValueOptions(array('' => '- Th??? lo???i -') + $array);
 		}
 	}

 	public function toSelectboxArray($items, $selectMode = \Admin\Model\Article::SELECT_MODE_ALL) {
 		if(is_array($items) && count($items)) {
 			/* @var $item \Product\Model\AProductc */
 			return $this->buildSelectBox(null, $this->buildTree($items), $selectMode);
 		}
 		return array();
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
 				/* @var $item \Product\Model\Article */
 				if($selectMode == \Admin\Model\Article::SELECT_MODE_LEAF) {
 					if(count($item->getChilds())) {
 						$result[$item->getName()] = $this->buildSelectBox(null, $item->getChilds(), $selectMode);
 					} else {
 						$result[$item->getId()] = $item->getName();
 					}
 				} else if ($selectMode == \Admin\Model\Article::SELECT_MODE_ALL) {
 					$sign = str_repeat(" - ", $level*5);
 					$result[$item->getId()] = $sign . $item->getName();
 					// array passed by value. change buildSelectBox(&$result) to pass by reference
 					$result += $this->buildSelectBox(null, $item->getChilds(), $selectMode, ++$level);
 				} else if ($selectMode == \Admin\Model\Article::SELECT_MODE_NORMAL) {
 					$result[$item->getId()] = $item->getName();
 					$result += $this->buildSelectBox(null, $item->getChilds(), $selectMode, ++$level);
 				} else {
 					$sign = str_repeat(" - ", $level*5);
 					$result[] = array('id' => $item->getId(), 'label' => $sign . $item->getName());
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
 			/* @var $item \Article\Model\Aarticle */
 			$ids[] = $item->getId();
 			$result[$item->getId()] = $item;
 			$tmp[$item->getId()] = $item;
 		}
 	
 		foreach($result as $item) {
 			if($item->getParentId() && in_array($item->getParentId(), $ids)) {
 				/* @var $d \Article\Model\Aarticle */
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

 	public function toStd(){
 		$a = new \stdClass();
 		$a->id= $this->getId();
 		$a->name = $this->getName();
 		$a->title = $this->getTitle();
 		$a->content = $this->getContent();
		return $a;
 	}

    public function toFormValues()
    {
        $data =  array(
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'content' => $this->getContent(),
            'status' => $this->getStatus(),
            'categoryId' => $this->getCategoryId(),
            'storeId' => $this->getStoreId(),
            'extraContent' => $this->getExtraContent(),
            'createdById' => $this->getCreatedById(),
            'tags' => $this->getTags(),
            'metaTitle' => $this->getMetaTitle(),
            'metaKeyword' => $this->getMetaKeyword(),
            'metaDescription' => $this->getMetaDescription(),
            'articleRelated' => $this->getArticleRelated(),
            'view' => $this->getView(),
            'url' => $this->getUrl(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 