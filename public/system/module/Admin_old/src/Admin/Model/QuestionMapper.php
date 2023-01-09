<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;


class QuestionMapper extends Base{
	
	protected $tableName = 'question';

    public function get($item)
    {
        if (! $item->getId() && !$item->getStoreId() && !$item->getTitle()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('q' => $this->getTableName()));

        if($item->getId() && $item->getStoreId()) {
            $select->where(['(q.id = ? AND q.storeId = ?)' => [$item->getId(), $item->getStoreId()]]);
        } else {
            if($item->getId()) {
                $select->where(['q.id' => $item->getId()]);
            }
            if($item->getStoreId()) {
                $select->where(['q.storeId' => $item->getStoreId()]);
            }
        }
        if($item->getTitle()) {
            $select->where(['q.title' => $item->getTitle()]);
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

    /**
     * @param \Admin\Model\Article $item
     */

	public function fetchAll($item)
	{
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
	
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("q" => $this->getTableName()));
	
 		if($item->getStoreId()) {
 			$select->where(array('q.storeId' => $item->getStoreId()));
 		}

		if($item->getTitle()) {
			$select->where("q.title LIKE '%{$item->getTitle()}%'");
		}
		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
	
		$rs = array();
		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\Question();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return $rs;
	}
	/**
	 * @param \Admin\Model\Question $model
	 */
	public function save($model) {
        $xss = new xssClean();
        $data = array(
            'storeId'=> $model->getStoreId(),
            'title' => $model->getTitle(),
            'content' => $model->getContent(),
            'createdById' => $model->getCreatedById(),
            'assignId' => $model->getAssignId(),
            'createdDateTime' => $model->getCreatedDateTime(),
            'updateDateTime' => $model->getUpdateDateTime(),
            'status' => $model->getStatus(),
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

    /**
     * @param \Admin\Model\Question $item
     */
	public function search($item,$paging){
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('ac'=>$this->getTableName()));
		$rCount = $dbSql->select(array('ac'=>$this->getTableName()),array('p'=>'count(id)'));

//		$select->join(array('a'=>'article_categories'),
//			'a.id = ac.categoryId',array(
//			'cateName' => 'name'
//			), \Zend\Db\Sql\Select::JOIN_LEFT
//		);

        if($item->getAssignId()){
            $select->where(array('ac.assignId' => $item->getAssignId()));
            $rCount->where(array('ac.assignId' => $item->getAssignId()));
        }
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
				$model = new \Admin\Model\Question();
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






















