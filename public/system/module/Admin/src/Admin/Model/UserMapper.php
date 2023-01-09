<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;


class UserMapper extends Base{
	
	protected $tableName = 'users';

    /**
     * @param \Admin\Model\User $item
     */
    public function get($item)
    {
//        print_r($item);die;
        $select = $this->getDbSql()->select(array('u' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['u.id' => $item->getId()]);
        }
//        if($item->getEmail() || $item->getUsername()) {
//            $select->where(['(u.email = ? OR u.username = ?)' => [$item->getEmail(), $item->getUsername()]]);
//        }
        if($item->getEmail()) {
            $select->where(['u.email' => $item->getEmail()]);
        }
        if($item->getUsername()) {
            $select->where(['u.username' => $item->getUsername()]);
        }
        if($item->getMobile()) {
            $select->where(['u.mobile' => $item->getMobile()]);
        }
        if($item->getStoreId()) {
            $select->where(['(u.storeId = ? OR u.parentStore = ?)' => [$item->getStoreId(), $item->getParentStore()]]);
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
	    if(!$item) {
	        return false;
        }
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
	
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("u" => $this->getTableName()));

//		if($item->getStoreId()) {
//            $select->where(['u.storeId' => $item->getStoreId()]);
//        }
        if($item->getEmail()) {
            $select->where(['u.email' => $item->getEmail()]);
        }

		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
	
		$rs = array();
		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\User();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return $rs;
	
	
	}
	/**
	 * @param \Admin\Model\User $model
	 */

	public function save($model) {
        $xss = new xssClean();
        $data = array(
            'storeId'=> $model->getStoreId(),
            'parentStore' => $model->getParentStore(),
            'username'=> $model->getUsername(),
            'email'=> $model->getEmail(),
            'role'=> $model->getRole(),
            'salt'=> $model->getSalt(),
            'password'=> $model->getPassword(),
            'fullName'=> $model->getFullName(),
            'gender'=> $model->getGender(),
            'birthday'=> $model->getBirthday(),
            'mobile'=> $model->getMobile(),
            'address'=> $model->getAddress(),
            'active'=> $model->getActive(),
            'activeKey'=> $model->getActiveKey(),
            'lock'=> $model->getLock(),
            'createdDateTime'=> $model->getCreatedDateTime(),
            'dependencies'=> $model->getDependencies(),
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
//			echo $selectString;die;
			$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		}
		return $results;
	}

    /**
     * @param \Admin\Model\User $item
     */

	public function search($item,$paging){
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('u'=>$this->getTableName()));
		$rCount = $dbSql->select(array('u'=>$this->getTableName()),array('p'=>'count(id)'));

        $select->join(array('st'=>'stores'),
            'st.id = u.storeId',array(
                'storeName' => 'name'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );

		if($item->getId()){
			$select->where(array('u.id'=>$item->getId()));
			$rCount->where(array('u.id'=>$item->getId()));
		}
		if($item->getStoreId()){
			$select->where(array('u.storeId = '.$item->getStoreId().' OR u.parentStore = '. $item->getParentStore()));
            $rCount->where(array('u.storeId = '.$item->getStoreId().' OR u.parentStore = '. $item->getParentStore()));
		}
//		if($item->getParentStore()) {
//            $select->where(array('u.parentStore'=>$item->getParentStore()));
//            $rCount->where(array('u.parentStore'=>$item->getParentStore()));
//        }

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
				$model = new \Admin\Model\User();
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






















