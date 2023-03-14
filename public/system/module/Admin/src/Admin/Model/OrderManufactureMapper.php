<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class OrderManufactureMapper extends Base{
	protected $tableName = 'order_manufacture';

    /**
     * @param \Admin\Model\OrderManufacture $model
     */
	public function save($model){
		$data = array(
			'orderId' => $model->getOrderId(),
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




}












