<?php

namespace News\Model;

use Base\Mapper\Base;

Class ArticleMapper extends Base
{
    /**
     * @var string
     */
    protected $tableName = 'articles';

    CONST TABLE_NAME = 'articles';

    /**
     * @param $id int
     * @return Article|null
     */
    public function get($item)
    {

        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        $dbSql = $this->getDbSql();

        $select = $dbSql->select(['at' => $this->getTableName()]);

        $select->join(array('a'=>'article_categories'),
            'a.id = at.categoryId',array(
                'cateName' => 'name'
            ), \Zend\Db\Sql\Select::JOIN_LEFT
        );

        if($item->getId()) {
            $select->where(['at.id = ?' => $item->getId()]);
        }
        if($item->getUrl()) {
            $select->where(['at.url = ?' => $item->getUrl()]);
        }
        $select->where(['at.status = ?' => Article::STATUS_ACTIVE]);
        if($item->getStoreId()) {
            $select->where(['at.storeId = ?' => $item->getStoreId()]);
        }
        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        $result = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);

        if ($result->count()) {
            $news = new Article();
            $news->exchangeArray((array)$result->current());
            return $news;
        }
        return null;
    }

    /**
     * @param Article $article
     * @return array|\Zend\Paginator\Paginator
     */
    public function search(Article $article)
    {
        $dbSql = $this->getDbSql();

        $select = $dbSql->select(['at' => self::TABLE_NAME]);

        $select->join(array('a'=>'article_categories'),
            'a.id = at.categoryId',array(
                'cateName' => 'name'
            ), \Zend\Db\Sql\Select::JOIN_LEFT
        );

        $select->where(['at.status = ?' => Article::STATUS_ACTIVE]);

        if ($article->getId()) {
            $select->where(['at.id' => $article->getId()]);
        }

        if($article->getTitle()){
            $nameLike = '%' . $article->getTitle() . '%';
            $select->where(['(at.title LIKE ? OR at.description LIKE ? OR at.content LIKE ?)' => [$nameLike, $nameLike, $nameLike]]);
        }

        if($article->getTags()) {
            $select->where("at.tags LIKE '%{$article->getTags()}%'");
        }
        if($article->getType()){
            $select->where(['at.type' => $article->getType()]);
        }
        if ($article->getStoreId()) {
            $select->where(['at.storeId = ?' => $article->getStoreId()]);
        }
        if ($article->getOption('excludedIds')) {
            $select->where(['at.id NOT IN (?)' => $article->getOption('excludedIds')]);
        }

        $select->where(['at.categoryId NOT IN (?)' => 21]);

        if ($article->getDomainId()) {
            $select->where(['at.domainId = ?' => $article->getDomainId()]);
        }
        if ($article->getCategoryId() || is_array($categories = $article->getCategoryIds()) && count($categories)) {
            if (is_array($categories = $article->getCategoryIds()) && count($categories)) {
                if ($article->getCategoryId()) {
                    $categories[] = $article->getCategoryId();
                }
                $select->where->in('at.categoryId', $categories);
            } else if ($article->getCategoryId()) {
                /* @var $categoryMapper \News\Model\CategoryMapper */
                $categoryMapper = $this->getServiceLocator()->get('News\Model\CategoryMapper');
                $category = new Category();
                $category->setStoreId($article->getStoreId());
                $category->setId($article->getCategoryId());
                $childIds = $categoryMapper->getChildIds($category);
                $childIds[] = $article->getCategoryId();
                $select->where(['at.categoryId' => $childIds]);

            }
        }
        if ($article->getOption('excludedIdc')) {
            $select->where(['at.categoryId NOT IN (?)' => $article->getOption('excludedIdc')]);
        }

        if (($limit = $article->getOption('limit')) && ($limit = abs($limit)) > 0) {
            $select->limit($limit > 50 ? 50 : $limit);

            if ($article->getOption('offset')) {
                $select->offset($article->getOption('offset'));
            }
            $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
            $selectStr = $dbSql->getSqlStringForSqlObject($select);
            $results = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);
            $articles = [];
            if ($results->count()) {
                foreach ($results as $row) {
                    $a = new Article();
                    $a->exchangeArray((array)$row);
                    $articles[] = $a;
                }
            }
            return $articles;
        }
        if ($article->getOption('icpp', 1) <= 0 || $article->getOption('icpp') > 50) {
            $article->addOption('icpp', 50);
        }
        $select->order('at.id DESC');
        $this->setSelect($select);

        $paginator = $this->getPaginatorForSelect(new Article(), $article->getOption('page', 1), $article->getOption('icpp', 20));
        return $paginator;
    }

    public function tagAll()
    {
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        $dbSql = $this->getDbSql();

        $select = $dbSql->select(['at' => self::TABLE_NAME]);
        $select->columns(array('tags'));
        $select->where('tags IS NOT NULL');
        $selectStr = $dbSql->getSqlStringForSqlObject($select);

        $results = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $tag = (array)$row;
                foreach ($tag as $t) {
                    $tags = explode(',', $t);
                    foreach ($tags as $tt) {
                        $rs[] = trim($tt);
                    }
                }
            }
        }
        return $rs;
    }


}