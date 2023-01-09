<?php
/**
 * @category    Shop99 library
 * @copyright   http://shop99.vn
 * @license     http://shop99.vn/license
 */

namespace News\Model;

use Base\Model\Base;

class Article extends Base
{
    const NEWS_SOURCE_TIN247 = 'SOURCE_TIN247';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var int
     */
    protected $domainId;

    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var array
     */
    protected $categoryIds;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var int
     */
    protected $hits;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var int
     */
    protected $sourceId;

    /**
     * @var string
     */
    protected $sourceLink;

    /**
     * @var \Datetime
     */
    protected $createdDateTime;

    /**
     * @var int
     */
    protected $createdById;

    /**
     * @var \DateTime
     */
    protected $publishedDate;

    /**
     * @var \DateTime
     */
    protected $expiredDate;

    /**
     * @var \DateTime
     */
    protected $modifiedDateTime;
    /**
     * @var string
     */

    protected $metaKeyword;
    protected $metaTitle;
    protected $metaDescription;

    protected $articleRelated;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $viewLink;

    /**
     * @var \User\Model\User
     */
    protected $user;

    /**
     * @var \News\Model\Category
     */
    protected $category;

    protected $type;

    protected $extraContent;

    protected $cateName;

    protected $view;

    protected $url;

    protected $tags;

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
     * @return array
     */
    public function getCategoryIds()
    {
        return $this->categoryIds;
    }

    /**
     * @param array $categoryIds
     */
    public function setCategoryIds($categoryIds)
    {
        $this->categoryIds = $categoryIds;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedDateTime()
    {
        return $this->modifiedDateTime;
    }

    /**
     * @param \DateTime $modifiedDateTime
     */
    public function setModifiedDateTime($modifiedDateTime)
    {
        $this->modifiedDateTime = $modifiedDateTime;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param \News\Model\Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return \News\Model\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if($name = $this->getTranslateOptions($this, 'content')) {
            return $name;
        }
        return $this->content;
    }

    /**
     * @param int $createdById
     */
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;
    }

    /**
     * @return int
     */
    public function getCreatedById()
    {
        return $this->createdById;
    }

    /**
     * @param \Datetime $createdDateTime
     */
    public function setCreatedDateTime($createdDateTime)
    {
        $this->createdDateTime = $createdDateTime;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @param int $domainId
     */
    public function setDomainId($domainId)
    {
        $this->domainId = $domainId;
    }

    /**
     * @return int
     */
    public function getDomainId()
    {
        return $this->domainId;
    }

    /**
     * @param \DateTime $expiredDate
     */
    public function setExpiredDate($expiredDate)
    {
        $this->expiredDate = $expiredDate;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * @param int $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * @return int
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * @param string $metaKeyword
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
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
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $picture
     */

    /**
     * @param \DateTime $publishedDate
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * @param int $sourceId
     */
    public function setSourceId($sourceId)
    {
        $this->sourceId = $sourceId;
    }

    /**
     * @return int
     */
    public function getSourceId()
    {
        return $this->sourceId;
    }

    /**
     * @param string $sourceLink
     */
    public function setSourceLink($sourceLink)
    {
        $this->sourceLink = $sourceLink;
    }

    /**
     * @return string
     */
    public function getSourceLink()
    {
        return $this->sourceLink;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if($name = $this->getTranslateOptions($this, 'title')){
            return $name;
        }
        return $this->title;
    }

    /**
     * @param \User\Model\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \User\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $viewLink
     */
    public function setViewLink($viewLink)
    {
        $this->viewLink = $viewLink;
    }

    /**
     * @return string
     */
    public function getPictureUri()
    {
        return \Base\Model\Uri::getImgSrc($this);
    }

    /**
     * @return string
     */
    public function getViewLink()
    {
        return !empty($this->getUrl()) ? '/'.$this->getUrl().'.html':\Base\Model\Uri::slugify($this);
    }

    public function getViewDemo()
    {
        return '/demo'.\Base\Model\Uri::slugify($this);
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
     * @return \stdClass
     */
    public function toStd()
    {
        $obj = new \stdClass();
        $obj->id = $this->getId();
        $obj->title = $this->getTitle();
        $obj->createdById = $this->getCreatedById();
        $obj->picture = $this->getPicture();
        $obj->pictureUri = $this->getPictureUri();
        $obj->viewLink = $this->getViewLink();
        $obj->categoryId = $this->getCategoryId();
        $obj->createdDateTime = $this->getCreatedDateTime();
        $obj->content = $this->getContent();
        if ($this->getUser()) {
            $obj->userFullName = $this->getUser()->getFullName();
        }
        return $obj;
    }

    public function prepareSearch($options = null, $request = null)
    {
        $variables = [];
        $name = strip_tags($request->getQuery('n'));
        if ($name) {
            $this->setTitle($name);
            $variables['n'] = $name;
        }
        return $variables;
    }

}