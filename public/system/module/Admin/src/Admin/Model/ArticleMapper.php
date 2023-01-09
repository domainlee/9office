<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;


class ArticleMapper extends Base{
	
	protected $tableName = 'articles';

    public function get($item)
    {
        if (! $item->getId() && !$item->getStoreId() && !$item->getTitle()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('ar' => $this->getTableName()));

        $select->join(array('a'=>'article_categories'),
            'a.id = ar.categoryId',array(
                'cateName' => 'name'
            ), \Zend\Db\Sql\Select::JOIN_LEFT
        );

        if($item->getId()) {
            $select->where(['ar.id' => $item->getId()]);
        }
        if($item->getStoreId()) {
            $select->where(['ar.storeId' => $item->getStoreId()]);
        }
        if($item->getTitle()) {
            $select->where(['ar.title' => $item->getTitle()]);
        }
        if($item->getUrl()) {
            $select->where(['ar.url' => $item->getUrl()]);
        }
        $select->limit(1);

        $dbSql = $this->getServiceLocator()->get('dbSql');
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $query = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);

        if ($results->count()) {
            $item->exchangeArray((array) $results->current());
            return $item;
        }

        return null;
    }

	public function getId($id){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("ac" => $this->getTableName()));
		$select->join(array('a'=>'article_categories'),
				'a.id = ac.categoryId',array(
						'cateName' => 'name'
				), \Zend\Db\Sql\Select::JOIN_LEFT
		);
		$select->where(array('ac.id'=>$id));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$result = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);
		if($result->count()){
			
				$model = new \Admin\Model\Article();
				$data = (array)$result->current();
				$model->exchangeArray($data);
				return $model;
		}
		return null;
	}

    /**
     * @param \Admin\Model\Article $item
     */

	public function fetchAll($item)
	{
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
	
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("a" => $this->getTableName()));
	
 		if($item->getStoreId()) {
 			$select->where(array('a.storeId' => $item->getStoreId()));
 		}

		if($item->getTitle()) {
			$select->where("a.title LIKE '%{$item->getTitle()}%'");
		}
		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
	
		$rs = array();
		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\Article();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return $rs;
	}
	/**
	 * @param \Admin\Model\Article $model
	 */

	public function save($model) {
        $xss = new xssClean();
        $data = array(
            'categoryId' => $model->getCategoryId(),
            'storeId'=> $model->getStoreId(),
            'image' => $model->getImage(),
            'title' => $model->getTitle(),
            'type' => $model->getType(),
            'description' => $model->getDescription(),
            'content' => $model->getContent(),
            'status' => $model->getStatus(),
            'extraContent' => $model->getExtraContent(),
            'createdById' => $model->getCreatedById(),
            'createdDateTime' => $model->getCreatedDateTime(),
            'tags' => $model->getTags(),
            'metaTitle' => $model->getMetaTitle(),
            'metaKeyword' => $model->getMetaKeyword(),
            'metaDescription' => $model->getMetaDescription(),
            'articleRelated' => $model->getArticleRelated(),
            'view' => $model->getView(),
            'url' => $model->getUrl(),
		);


        $data = $xss->cleanInputs($data);
        $data['content'] = $model->getContent();
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		if (!$model->getId()) {
			$insert = $dbSql->insert($this->getTableName());
			$insert->values($data);
			$query = $dbSql->getSqlStringForSqlObject($insert);
			$results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
            $model->setId($results->getGeneratedValue());
        } else {
			$update = $dbSql->update($this->getTableName());
			$update->set($data);
			$update->where(array("id" => (int)$model->getId()));
			$selectString = $dbSql->getSqlStringForSqlObject($update);
			$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		}
		return $results;
	}
	
	public function search($item,$paging){
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('ac'=>$this->getTableName()));
		$rCount = $dbSql->select(array('ac'=>$this->getTableName()),array('p'=>'count(id)'));
		$select->join(array('a'=>'article_categories'),
			'a.id = ac.categoryId',array(
			'cateName' => 'name'
			), \Zend\Db\Sql\Select::JOIN_LEFT
		);
		
		if($item->getId()){
			$select->where(array('ac.id'=>$item->getId()));
			$rCount->where(array('ac.id'=>$item->getId()));
		}
        if($item->getStatus()){
            $select->where(array('ac.status'=>$item->getStatus()));
            $rCount->where(array('ac.status'=>$item->getStatus()));
        }
		if($item->getStoreId()){
			$select->where(array('ac.storeId'=>$item->getStoreId()));
			$rCount->where(array('ac.storeId'=>$item->getStoreId()));
		}
		if($item->getTitle()){
			$select->where("ac.title LIKE '%{$item->getTitle()}%'");
			$rCount->where("ac.title LIKE '%{$item->getTitle()}%'");
		}
		$currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
		$limit = isset ( $paging [1] ) ? $paging [1] : 20;
		$offset = ($currentPage - 1) * $limit;
		$select->limit ( $limit );
		$select->offset ( $offset );
		$select->order ( 'ac.id DESC' );
		
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
		$results = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);
		$count = $dbAdapter->query($rCountStr, $dbAdapter::QUERY_MODE_EXECUTE);
		$rs = array();
		if($results->count()){
			foreach ($results as $row){
				$model = new \Admin\Model\Article();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return new \Base\Dg\Paginator($count->count(),$rs, $paging, count($results));
	}

	public function delete($item){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
	
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$select = $dbSql->delete($this->getTableName());
		$select->where(array('id'=>$item->getId()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}

    public function related($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("a" => $this->getTableName()));

        if($item->getStoreId()){
            $select->where(array('a.storeId'=> $item->getStoreId()));
        }

        if($item->getTitle()){
            $select->where("a.title LIKE '%{$item->getTitle()}%'");
        }
        $select->limit (10);
        $select->order ( 'a.id DESC' );
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $k => $row) {
                $rs[$k]['id'] = $row['id'];
                $rs[$k]['text'] = $row['title'];
            }
        }
        return $rs;
    }

}






















