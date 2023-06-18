<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class OrderManufactureMapper extends Base{
	protected $tableName = 'order_manufacture';

    /**
     * @param \Admin\Model\OrderManufacture $item
     */
    public function get($item)
    {
        if (!$item->getId() && !$item->getOrderId()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('ac' => $this->getTableName()));

        if($item->getId()) {
            $select->where(['ac.id' => $item->getId()]);
        }
        if($item->getOrderId()){
            $select->where(['ac.orderId'=> $item->getOrderId()]);
        }
        if($item->getProductId()){
            $select->where(['ac.productId'=> $item->getProductId()]);
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
     * @param \Admin\Model\OrderManufacture $model
     */
	public function save($model){
		$data = array(
			'orderId' => $model->getOrderId(),
			'productId' => $model->getProductId(),
			'status' => $model->getStatus(),
			'quantity' => $model->getQuantity(),
			'price' => $model->getPrice(),
			'intoMoney' => $model->getIntoMoney(),
			'createdDateTime' => $model->getCreatedDateTime(),
			'createdById' => $model->getCreatedById(),
			'startDateTime' => $model->getStartDateTime(),
			'endDateTime' => $model->getEndDateTime(),
		);
        $xss = new xssClean();
        $data = $xss->cleanInputs($data);
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		if($model->getId() == null){
			$insert = $dbSql->insert($this->getTableName());
			$insert->values($data);
			$insertStr = $dbSql->getSqlStringForSqlObject($insert);
            $results = $dbAdapter->query($insertStr,$dbAdapter::QUERY_MODE_EXECUTE);
		}else{
			$update = $dbSql->update($this->getTableName());
			$update->set($data);
			$update->where(array('id'=>$model->getId()));
			$updateStr = $dbSql->getSqlStringForSqlObject($update);
            $results = $dbAdapter->query($updateStr,$dbAdapter::QUERY_MODE_EXECUTE);
		}
		return $results;
	}


    public function fetchAll($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("ac" => $this->getTableName()));

        if($item->getId()) {
            $select->where(array('ac.id' => $item->getId()));
        }
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $all = array();
        if($results->count()) {
            foreach ($results as $row) {
//                $modelMaterial = new \Admin\Model\Material();
//                $modelMaterial->setId($row['materialId']);
//                $mapperMaterial = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
//                $resultMaterial = $mapperMaterial->get($modelMaterial);
                $all[$row['orderId']] = array(
                    $row['productId'] => $row['productId'],
                    'orderId' => $row['orderId'],
                    'status' => $row['status'],
                    'startDateTime' => $row['startDateTime'],
                    'endDateTime' => $row['endDateTime'],
                );
            }
        }
        return $all;
    }

    public function fetchStatus($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("ac" => $this->getTableName()));

        if($item->getStatus()) {
            $select->where(array('ac.status' => $item->getStatus()));
        }
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $all = array();
        if($results->count()) {
            foreach ($results as $row) {
                $all[] = $row['orderId'];
            }
        }
        return $all;
    }






}












