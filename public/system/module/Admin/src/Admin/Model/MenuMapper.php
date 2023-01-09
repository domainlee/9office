<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class MenuMapper extends Base{
	
	protected $tableName = 'menu';

    /**
     * @param \Admin\Model\Menu $item
     */
    public function get($item)
    {
        if (!$item->getId() && !$item->getNameKey() && !$item->getStoreId()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('m' => $this->getTableName()));
        if($item->getId()){
            $select->where(['m.id' => $item->getId()]);
        }
        if($item->getNameKey()){
            $select->where(['m.nameKey' => $item->getNameKey()]);
        }
        if($item->getStoreId()){
            $select->where(['m.storeId' => $item->getStoreId()]);
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
     * @param \Admin\Model\Menu $item
     */
    public function checkExits($item)
    {

        if (!$item->getNameKey() && !$item->getStoreId() ) {
            return null;
        }
        $select = $this->getDbSql()->select(array('ar' => $this->getTableName()));
        $select->where(['ar.storeId' => $item->getStoreId()]);
        $select->where(['ar.nameKey' => $item->getNameKey()]);
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
     * @param \Admin\Model\Menu $item
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
        $selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
	
		$rs = array();
		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\Menu();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return $rs;
	}
	/**
	 * @param \Admin\Model\Menu $model
	 */
	public function save($model) {
		$data = array(
            'name' => $model->getName(),
            'nameKey' => $model->getNameKey(),
            'storeId' => $model->getStoreId(),
            'menu' => $model->getMenu(),
		);
        $xss = new xssClean();
        $data = $xss->cleanInputs($data);
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
            $update->where(['id' => $model->getId()]);
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
		if($item->getStoreId()){
			$select->where(array('ac.storeId'=>$item->getStoreId()));
			$rCount->where(array('ac.storeId'=>$item->getStoreId()));
		}
		if($item->getName()){
			$select->where("ac.name LIKE '%{$item->getName()}%'");
			$rCount->where("ac.name LIKE '%{$item->getName()}%'");
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

		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$select = $dbSql->delete($this->getTableName());
        $select->where(array('id' => $item->getId()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}

    public function delete2($item){

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $select = $dbSql->delete($this->getTableName());
        if($item->getId()) {
            $select->where(['id NOT IN (?)' => $item->getId()]);
        }
        if($item->getStoreId()) {
            $select->where(array('storeId' => $item->getStoreId()));
        }

        $selectStr = $dbSql->getSqlStringForSqlObject($select);

        return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
    }


}






















