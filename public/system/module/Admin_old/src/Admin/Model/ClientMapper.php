<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;


class ClientMapper extends Base{
	
	protected $tableName = 'client';

    /**
     * @param \Admin\Model\Client $item
     */
    public function get($item)
    {
        $select = $this->getDbSql()->select(array('u' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['u.id' => $item->getId()]);
        }
        if($item->getEmail()) {
            $select->where(['u.email' => $item->getEmail()]);
        }
        if($item->getPhone()) {
            $select->where(['u.phone' => $item->getPhone()]);
        }
        if($item->getStoreId()) {
            $select->where(['u.storeId' => $item->getStoreId()]);
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
	
	public function fetchAll($item)
	{
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
	
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("u" => $this->getTableName()));

		if($item->getStoreId()) {
            $select->where(['u.storeId' => $item->getStoreId()]);
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
	 * @param \Admin\Model\Client $model
	 */

	public function save($model) {
        $xss = new xssClean();
        $data = array(
            'storeId' => $model->getStoreId(),
            'code' => $model->getCode(),
            'name' => $model->getName(),
            'phone' => $model->getPhone(),
            'email' => $model->getEmail(),
            'address' => $model->getAddress(),
            'birthday' => $model->getBirthday(),
            'gender' => $model->getGender(),
            'createdDateTime' => $model->getCreatedDateTime(),
            'extraContent' => $model->getExtraContent(),
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
            return $model;
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
     * @param \Admin\Model\Client $item
     */

	public function search($item, $paging){
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('u'=>$this->getTableName()));
		$rCount = $dbSql->select(array('u'=>$this->getTableName()),array('p'=>'count(id)'));

//        $select->join(array('st'=>'stores'),
//            'st.id = u.storeId',array(
//                'storeName' => 'name'
//            ),\Zend\Db\Sql\Select::JOIN_LEFT
//        );

		if($item->getId()){
			$select->where(array('u.id'=>$item->getId()));
			$rCount->where(array('u.id'=>$item->getId()));
		}

        if($item->getOptions('keySearch')){
            $nameLike = '%' . $item->getName() . '%';
            $select->where(['(u.name LIKE ? OR u.phone LIKE ?)' => [$nameLike, $nameLike]]);
            $rCount->where(['(u.name LIKE ? OR u.phone LIKE ?)' => [$nameLike, $nameLike]]);
        }


		$currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
		$limit = isset ( $paging [1] ) ? $paging [1] : 20;
		$offset = ($currentPage - 1) * $limit;
		$select->limit ( $limit );
		$select->offset ( $offset );
		$select->order ( 'u.id DESC' );
		
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
		$results = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);
		$count = $dbAdapter->query($rCountStr, $dbAdapter::QUERY_MODE_EXECUTE);
		$rs = array();
		if($results->count()){
			foreach ($results as $row){
				$model = new \Admin\Model\Client();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return new \Base\Dg\Paginator($count->count(),$rs, $paging, count($results));
	}

	public function delete($item){
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$select = $dbSql->delete($this->getTableName());
		$select->where(array('id'=>$item->getId()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}


}






















