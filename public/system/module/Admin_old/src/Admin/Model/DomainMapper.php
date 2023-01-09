<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class DomainMapper extends Base{
	
	protected $tableName = 'store_domains';

    public function get($item)
    {
        if (!$item->getId() && !$item->getStoreId() ) {
            return null;
        }
        $select = $this->getDbSql()->select(array('ar' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['ar.id' => $item->getId()]);
        }
        if($item->getName()) {
            $select->where(['ar.name' => $item->getName()]);
        }
        if($item->getStoreId()) {
            $select->where(['(ar.storeId = ? OR ar.parentStoreId = ?)' => [$item->getStoreId(), $item->getParentStoreId()]]);
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
        if (!$item->getStoreId() ) {
            return null;
        }
        $select = $this->getDbSql()->select(array('ar' => $this->getTableName()));

        if($item->getStoreId()) {
            $select->where(['ar.storeId' => $item->getStoreId()]);
        }
        if($item->getName()) {
            $select->where(['(ar.name = ? OR ar.alias = ?)' => [$item->getName(), $item->getName()]]);
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
		$select = $dbSql->select(array("a" => $this->getTableName()));
	
 		if($item->getStoreId()) {
 			$select->where(array('a.storeId' => $item->getStoreId()));
 		}
		if($item->getName()) {
			$select->where("a.name LIKE '%{$item->getName()}%'");
		}
		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
	
		$rs = array();

		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\Domain();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return $rs;
	}
	/**
	 * @param \Admin\Model\Domain $model
	 */

	public function save($model) {
		$data = array(
            'storeId' => $model->getStoreId(),
            'uitemplateId' => $model->getUitemplateId(),
            'name' => $model->getName(),
            'alias' => $model->getAlias(),
            'description' => $model->getDescription(),
            'optionPage' => $model->getOptionPage(),
            'homePage' => $model->getHomePage(),
            'createdDateTime' => $model->getCreatedDateTime(),
            'parentStoreId' => $model->getParentStoreId(),
		);
//        $xss = new xssClean();
//        $data = $xss->cleanInputs($data);

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

        $select->join(array('st'=>'stores'),
            'st.id = ac.storeId',array(
                'storeName' => 'name'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );

        $select->join(array('ui'=>'uitemplates'),
            'ui.id = ac.uitemplateId',array(
                'uiName' => 'directory'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );

		if($item->getId()){
			$select->where(array('ac.id'=>$item->getId()));
			$rCount->where(array('ac.id'=>$item->getId()));
		}
		if($item->getStoreId()){
            $select->where(array('ac.storeId = '.$item->getStoreId().' OR ac.parentStoreId = '. $item->getParentStoreId()));
            $rCount->where(array('ac.storeId = '.$item->getStoreId().' OR ac.parentStoreId = '. $item->getParentStoreId()));
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
				$model = new \Admin\Model\Domain();
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
		$select->where(array('id'=>$item->getId()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}

    public function deleteStore($storeId){
	    if(!$storeId) {
	        return null;
        }
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $selectStr = 'DELETE FROM `articles` WHERE storeId='.$storeId.';
                      DELETE FROM `article_categories` WHERE storeId='.$storeId.';
                      DELETE FROM `banners` WHERE storeId='.$storeId.';
                      DELETE FROM `brand` WHERE storeId='.$storeId.';
                      DELETE FROM `media` WHERE storeId='.$storeId.';
                      DELETE FROM `media_item` WHERE storeId='.$storeId.';
                      DELETE FROM `menu` WHERE storeId='.$storeId.';
                      DELETE FROM `options` WHERE storeId='.$storeId.';
                      DELETE FROM `orders` WHERE storeId='.$storeId.';
                      DELETE FROM `order_products` WHERE storeId='.$storeId.';
                      DELETE FROM `pages` WHERE storeId='.$storeId.';
                      DELETE FROM `products` WHERE storeId='.$storeId.';
                      DELETE FROM `product_attr` WHERE storeId='.$storeId.';
                      DELETE FROM `product_attr_list` WHERE storeId='.$storeId.';
                      DELETE FROM `product_categories` WHERE storeId='.$storeId.';
                      DELETE FROM `stores` WHERE id='.$storeId.';
                      DELETE FROM `store_domains` WHERE storeId='.$storeId.';
                      DELETE FROM `users` WHERE storeId='.$storeId.';';
        return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
    }

}






















