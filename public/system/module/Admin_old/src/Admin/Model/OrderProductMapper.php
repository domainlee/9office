<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class OrderProductMapper extends Base{
	protected $tableName = 'order_products';

    /**
     * @param \Admin\Model\OrderProduct $model
     */
	public function save($model){
		$data = array(
			'orderId' => $model->getOrderId(),
			'productId' => $model->getProductId(),
			'storeId' => $model->getStoreId(),
			'productPrice' => $model->getProductPrice(),
			'quantity' => $model->getQuantity(),
			'priceOff' => $model->getPriceOff(),
			'productName' => $model->getProductName(),
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

	public function updateQtt($model){
		$data = array(
				'quantity' => $model->getQuantity(),
		);
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('odp'=>'order_products'));
		$select->join(array('od'=>'orders'),
				'od.id = odp.orderId',
				array(
						'name'=>'name'
				)
		);
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
		if(count($results)){
			
		}
		if(count($results)){
			foreach ($results as $row){
				$orderPro = new \Admin\Model\OrderProduct();
				$orderPro->exchangeArray((array)$row);
				$product = new \Admin\Model\Product();
				$quantity = ($orderPro->getQuantity() - $product->getQuantity());
				$product->setQuantity($quantity);
				$update = $dbSql->update('products');
				$update->set($data);
				$update->where(array(
					'id'=>$orderPro->getProductId()
				));
				$updateStr = $dbSql->getSqlStringForSqlObject($update);
				echo $updateStr;
				return $dbAdapter->query($updateStr,$dbAdapter::QUERY_MODE_EXECUTE);
			}
		}
	}

    /**
     * @param \Admin\Model\OrderProduct $item
     */

    public function deleteType($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $delete = $this->getDbSql()->delete($this->getTableName());
        $delete->where(['orderId' => $item->getOrderId()]);
        $delete->where(['storeId' => $item->getStoreId()]);
        $query = $dbSql->getSqlStringForSqlObject($delete);
        $result = $dbAdapter->query($query,$dbAdapter::QUERY_MODE_EXECUTE);
        return $result;
    }

    public function report($item,$paging){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');

        $select = $dbSql->select(array('p'=> $this->getTableName()));
        $rCount = $dbSql->select(array('p'=> $this->getTableName()),array('c'=>'count(id)'));

        $select->columns(array(new \Zend\Db\Sql\Expression('p.*, SUM(quantity) as quantityTotal')));
        $rCount->columns(array(new \Zend\Db\Sql\Expression('p.*, SUM(quantity) as quantityTotal')));

        $select->group('p.productId');
        $rCount->group('p.productId');

        if($item->getStoreId()){
            $select->where(array('p.storeId'=>$item->getStoreId()));
            $rCount->where(array('p.storeId'=>$item->getStoreId()));
        }
        $currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
        $limit = isset ( $paging [1] ) ? $paging [1] : 20;
        $offset = ($currentPage - 1) * $limit;
        $select->limit ( $limit );
        $select->offset ( $offset );
        
        $select->order ( 'quantityTotal DESC' );
        
        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        $rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
//        echo $selectStr;die;
        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if(count($results)){
            foreach ($results as $rows){
                $model = new \Admin\Model\OrderProduct();
                $model->exchangeArray((array) $rows);
                $rs[] = $model;
            }
        }
        return new \Base\Dg\Paginator ( $count->count (), $rs, $paging, count ( $results ) );
    }


}












