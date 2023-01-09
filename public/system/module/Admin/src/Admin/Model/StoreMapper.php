<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class StoreMapper extends Base{

	protected $tableName = 'stores';

    public function get($item)
    {
        if (! $item->getId() && !$item->getName()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('s' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['s.id' => $item->getId()]);
        }
        if($item->getName()) {
            $select->where(['s.name' => $item->getName()]);
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

    public function get2($item)
    {
        if (! $item->getId() && !$item->getName()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('s' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['s.id' => $item->getId()]);
        }
        if($item->getName()) {
            $select->where(['s.name' => $item->getName()]);
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
		
		$select = $dbSql->select(array('st'=>$this->getTableName()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
		if(count($results)){
			$model = new \Admin\Model\Store();
			$data = (array)$results->current();
			$model->exchangeArray($data);
			return $model;
		}
	}
	
	public function fetchAll($item){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		$select = $dbSql->select(array('st'=>$this->getTableName()));
		if($item->getParentId()){
			$select->where(array('st.parentId'=>$item->getParentId()));
		}
        if($item->getId()){
            $select->where(array('st.id'=>$item->getId()));
        }
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
		$rs = array();
		if(count($results)){
			foreach ($results as $rows){
				$model = new \Admin\Model\Store();
				$model->exchangeArray((array)$rows);
				$rs[] = $model;
			}
		}
		return $rs;
	}
	public function search($item,$paging){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		$select = $dbSql->select(array('st'=>$this->getTableName()));
		$rCount = $dbSql->select(array('st'=>$this->getTableName()),array('c'=>'count(id)'));

		
		$currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
		$limit = isset ( $paging [1] ) ? $paging [1] : 20;
		$offset = ($currentPage - 1) * $limit;
		$select->limit ( $limit );
		$select->offset ( $offset );
		$select->order ( 'st.id DESC' );
		
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$rCountStr = $dbSql->getSqlStringForSqlObject($rCount);		
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
		$count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);
		
		$rs = array();
		if(count($results)){
			foreach ($results as $rows){
				$model = new \Admin\Model\Store();
				$model->exchangeArray((array) $rows);
				$rs[] = $model;
			}
		}
		return new \Base\Dg\Paginator ( $count->count (), $rs, $paging, count ( $results ) );
	}

    public function save($model) {
        $xss = new xssClean();
        $data = array(
            'name' => $model->getName(),
            'status' => $model->getStatus(),
        );

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
            $update->where(array("id" => (int)$model->getId()));
            $selectString = $dbSql->getSqlStringForSqlObject($update);
            $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
        }
        return $results;
    }

    /**
     * @param \Admin\Model\Store $item
     */
    public function related($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("s" => $this->getTableName()));

        if($item->getName()){
            $select->where("s.name LIKE '%{$item->getName()}%'");
        }
        $select->limit (10);
        $select->order ( 's.id DESC' );
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $k => $row) {
                $rs[$k]['id'] = $row['id'];
                $rs[$k]['text'] = $row['name'];
            }
        }
        return $rs;
    }

}


















