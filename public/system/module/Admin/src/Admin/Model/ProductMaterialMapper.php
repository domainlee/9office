<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;


class ProductMaterialMapper extends Base{
	protected $tableName = 'product_material';

    public function get($item)
    {
        if (!$item->getId() && !$item->getProductId()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('ac' => $this->getTableName()));

        if($item->getId()) {
            $select->where(['ac.id' => $item->getId()]);
        }
        if($item->getProductId()) {
            $select->where(['ac.productId' => $item->getProductId()]);
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
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		$select = $dbSql->select(array('ac'=>$this->getTableName()));
		$select->join(array('a' => 'article_categories'),
				'a.id  =  ac.parentId', array(
						'parentName' => 'name',
				),
				\Zend\Db\Sql\Select::JOIN_LEFT
		);
		$select->where(array('ac.id'=>$id));
		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		if($results->count()){
			$model = new \Admin\Model\ProductMaterial();
			$data = (array)$results->current();
			$model->exchangeArray($data);
			return $model;
		}
		return null;
	}

	
	public function fetchAll($item){

		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		$select = $dbSql->select(array('ac'=>$this->getTableName()));

        if($item->getStoreId()){
            $select->where(array('ac.storeId'=>$item->getStoreId()));
        }
		if($item->getExcludedId()) {
			$select->where("m.id <> {$item->getExcludedId()}");
		}
		$selectString = $dbSql->getSqlStringForSqlObject($select);

		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		$rs = array();
		foreach ($results as $row){
			$model = new \Admin\Model\ProductMaterial();
			$model->exchangeArray((array)$row);
			$rs[] = $model;			
		}
		return $rs;
	}

    public function fetchAll2($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("ac" => $this->getTableName()));

        if($item->getId()) {
            $select->where(array('ac.id' => $item->getId()));
        }
        if($item->getStoreId()){
            $select->where(array('ac.storeId' => $item->getStoreId()));
        }
        if($item->getParentId()){
            $select->where(array('ac.parentId' => $item->getParentId()));
        }
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $model = new \Admin\Model\ProductMaterial();
                $model->exchangeArray((array)$row);
                $rs[] = $model;
            }
        }
        return $rs;
    }


    /**
     * @param \Admin\Model\ProductMaterial $model
     */
	public function save($model){
        $xss = new xssClean();
        $data = array(
            'productId' => $model->getProductId(),
            'image' => $model->getImage(),
            'name' => $model->getName(),
            'createdDateTime' => $model->getCreatedDateTime(),
            'createdById' => $model->getCreatedById(),
		);
        $data = $xss->cleanInputs($data);
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$dbSql = $this->getServiceLocator()->get('dbSql');
		if(!$model->getId()){
			$insert = $dbSql->insert($this->getTableName());
			$insert->values($data);
			$query = $dbSql->getSqlStringForSqlObject($insert);
			$results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
            $model->setId($results->getGeneratedValue());
        }
		else {
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
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('ac'=>$this->getTableName()));
		$rCount  =$dbSql->select(array('ac'=>$this->getTableName()),array('p'=>'count(id)'));

		if($item->getId()){
			$select->where(array('ac.id'=>$item->getId()));
			$rCount->where(array('ac.id'=>$item->getId()));
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
				$model = new \Admin\Model\ProductMaterial();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return new \Base\Dg\Paginator ( $count->count (), $rs, $paging, count ( $results ) );
	}
	
	public function delete($item){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->delete($this->getTableName());
		$select->where(array('id'=>$item->getId()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}
	public function getChildren($item) {
		$model = new \Admin\Model\Productc();
		$model->setParentId($item->getId());
		$children = $this->fetchAll($model);
		if(count($children)) {
			return $children;
		}
		return false;
	}
	/**
	 *
	 * @param array<\Restaurant\Model\PositionCategory> $children
	 */
	public function deleteAllChildren($children) {
		if(count($children)) {
			foreach ($children as $item) {
				if(($itemChilds = $this->getChildren($item)) != false) {
					$this->deleteAllChildren($itemChilds);
				}
				$this->delete($item);
			}
		}
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

        if($item->getName()){
            $select->where("a.name LIKE '%{$item->getName()}%'");
        }
        $select->limit (10);
        $select->order ( 'a.id DESC' );
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


















