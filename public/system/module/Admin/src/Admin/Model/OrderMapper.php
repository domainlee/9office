<?php
namespace Admin\Model;

use Base\Mapper\Base;
use \Base\XSS\xssClean;
use mysql_xdevapi\Exception;

class OrderMapper extends Base{

	protected $tableName = 'orders';
    const TABLE_NAME = 'orders';

    /**
     * @param \Admin\Model\Order $item
     */

    public function get($item){
        if(!$item->getId() && !$item->getStoreId()){
            return null;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array('o'=> self::TABLE_NAME));
        if($item->getId()){
            $select->where(array('o.id'=> $item->getId()));
        }
        if($item->getStoreId()){
            $select->where(array('o.storeId'=> $item->getStoreId()));
        }
        $selectStr = $dbSql->getSqlStringForSqlObject($select);

        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        if(count($results)){
            $item->exchangeArray((array)$results->current());
            return $item;
        }
    }

    /**
     * @param \Admin\Model\Order $item
     */
    public function getStatus($item){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array('o'=> self::TABLE_NAME));

        if($item->getShippingType()){
            $select->where(array('o.shippingType'=> $item->getShippingType()));
        }
        if($item->getStoreId()){
            $select->where(array('o.storeId'=> $item->getStoreId()));
        }
        $selectStr = $dbSql->getSqlStringForSqlObject($select);

        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        return count($results);
    }

    public function search($item,$paging){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');

        $select = $dbSql->select(array('p'=>self::TABLE_NAME));
        $rCount = $dbSql->select(array('p'=>self::TABLE_NAME),array('c'=>'count(id)'));

        $select->join(array('op' => 'order_products'),
            'op.orderId = p.orderId',array(
                'productCode' => 'productCode',
                'stock' => 'stock'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );
        $rCount->join(array('op' => 'order_products'),
            'op.orderId = p.orderId',array(
                'productCode' => 'productCode',
                'stock' => 'stock'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );
        $datefrom = $item->getOptions()['start_date'];
        $dateto = $item->getOptions()['end_date'];
        if($datefrom || $dateto) {
            $select->where("(p.createdDateTime >= '$datefrom 00:00:00' AND p.createdDateTime <= '$dateto 23:59:59')");
            $rCount->where("(p.createdDateTime >= '$datefrom 00:00:00' AND p.createdDateTime <= '$dateto 23:59:59')");
        }
        if($item->getProductCode()) {
            $select->where("op.productCode LIKE '%{$item->getProductCode()}%'");
            $rCount->where("op.productCode LIKE '%{$item->getProductCode()}%'");
        }
        if($item->getOrderId()){
            $select->where(array('p.orderId'=>$item->getOrderId()));
            $rCount->where(array('p.orderId'=>$item->getOrderId()));
        }

        if($item->getStatusCode() == 'InProduction') {
            $orderManufacture = new \Admin\Model\OrderManufacture();
            $orderManufacture->setStatus(1);
            $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
            $resultOrderIds = $orderManufactureMapper->fetchAllStatus($orderManufacture, 'order');
            $orderIds = implode(',', $resultOrderIds);
            $resultProductIds = $orderManufactureMapper->fetchAllStatus($orderManufacture, 'product');
            $productIds = implode(',', $resultProductIds);
            $select->where('p.orderId in ('.$orderIds.') AND op.productCode in ('.$productIds.')');
            $rCount->where('p.orderId in ('.$orderIds.') AND op.productCode in ('.$productIds.')');
        } elseif($item->getStatusCode() == 'FinishedProduction') {
            $orderManufacture = new \Admin\Model\OrderManufacture();
            $orderManufacture->setStatus(2);
            $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
            $resultOrderIds = $orderManufactureMapper->fetchAllStatus($orderManufacture, 'order');
            $orderIds = implode(',', $resultOrderIds);
            $resultProductIds = $orderManufactureMapper->fetchAllStatus($orderManufacture, 'product');
            $productIds = implode(',', $resultProductIds);
            $select->where('p.orderId in ('.$orderIds.') AND op.productCode in ('.$productIds.')');
            $rCount->where('p.orderId in ('.$orderIds.') AND op.productCode in ('.$productIds.')');
        } elseif($item->getStatusCode() == 'StockLess') {
            $select->where('(NOT op.stock > 0 OR op.stock IS NULL)');
            $rCount->where('(NOT op.stock > 0 OR op.stock IS NULL)');
        } elseif($item->getStatusCode() || $item->getStatusCode() != 'InProduction' || $item->getStatusCode() != 'FinishedProduction' || $item->getStatusCode() != 'StockLess') {
            $select->where("p.statusCode LIKE '%{$item->getStatusCode()}%'");
            $rCount->where("p.statusCode LIKE '%{$item->getStatusCode()}%'");
        }

        $select->where(array('p.depotId' => 110912));
        $rCount->where(array('p.depotId' => 110912));
        $currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
        $limit = isset ( $paging [1] ) ? $paging [1] : 20;
        $offset = ($currentPage - 1) * $limit;
        $select->limit ( $limit );
        $select->offset ( $offset );
        $select->order ( 'p.createdDateTime DESC' );

        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        $rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $rs = array();
        if(count($results)){
            foreach ($results as $rows){
                $model = new \Admin\Model\Order();
                $products = '';
                if($rows['productCode']) {
                    $orderProduct = new \Admin\Model\OrderProduct();
                    $orderProduct->setProductCode($rows['productCode']);
                    $orderProduct->setOrderId($rows['orderId']);
                    $orderProductMapper = $this->getServiceLocator()->get('Admin\Model\OrderProductMapper');
                    $products = $orderProductMapper->fetchAll($orderProduct);
                    $model->setOptions(['products' => $products]);
                }
                $model->exchangeArray((array) $rows);
                $rs[] = $model;
            }
        }
        return new \Base\Dg\Paginator ( $count->count (), $rs, $paging, count ( $results ) );
    }

    public function searchTwo($item,$paging){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');

        $select = $dbSql->select(array('p'=>self::TABLE_NAME));
        $rCount = $dbSql->select(array('p'=>self::TABLE_NAME),array('c'=>'count(id)'));

        $select->join(array('op' => 'order_products'),
            'op.orderId = p.orderId',array(
                'productCode' => 'productCode'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );
        $rCount->join(array('op' => 'order_products'),
            'op.orderId = p.orderId',array(
                'productCode' => 'productCode',
                'productImage' => 'productImage',
                'productName' => 'productName',
                'quantity' => 'quantity',
                'stock' => 'stock',
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );
        $datefrom = $item->getOptions()['start_date'];
        $dateto = $item->getOptions()['end_date'];
        if($datefrom || $dateto) {
            $select->where("(p.createdDateTime >= '$datefrom 00:00:00' AND p.createdDateTime <= '$dateto 23:59:59')");
            $rCount->where("(p.createdDateTime >= '$datefrom 00:00:00' AND p.createdDateTime <= '$dateto 23:59:59')");
        }
        if($item->getProductCode()) {
            $select->where("op.productCode LIKE '%{$item->getProductCode()}%'");
            $rCount->where("op.productCode LIKE '%{$item->getProductCode()}%'");
        }
        if($item->getStatusCode()) {
            $select->where("p.statusCode LIKE '%{$item->getStatusCode()}%'");
            $rCount->where("p.statusCode LIKE '%{$item->getStatusCode()}%'");
        }
        if($item->getOrderId()){
            $select->where(array('p.orderId'=>$item->getOrderId()));
            $rCount->where(array('p.orderId'=>$item->getOrderId()));
        }
        $select->where(array('p.depotId' => 110912));
        $rCount->where(array('p.depotId' => 110912));
        $rCount->order ( 'p.createdDateTime DESC' );

        $rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
        $count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $rs = array();
        if(count($count)){
            foreach ($count as $rows){
                $model = array($rows['orderId'], $rows['customerName'], $rows['productImage'], $rows['productCode'], $rows['productName'], $rows['quantity'], $rows['stock'], $rows['createdDateTime'], $rows['statusName']);
                $rs[] = $model;
            }
        }
        return $rs;
    }


	public function updateQtt($item){
// 		$data = array(
// 				'quantity' => $model->getQuantity(),
// 		);
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("od" => $this->getTableName()));
		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString,$dbAdapter::QUERY_MODE_EXECUTE);
		$rs = array();
		$orderIds = array();
		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\Order();
				$model->exchangeArray((array)$row);
		
				$orderIds[] = $model->getId();
				$rs[$model->getId()] = $model;
				unset($row);
			}
		}
		// get detail bill
		unset($select);
		unset($selectString);
		unset($results);
		$proId = array();
		if(count($orderIds)) {
			$select = $dbSql->select(array("od" => 'order_products'));
			$select->join(array('d' => 'products'),
					'd.id = od.productId', array(
							'd.name' => 'name',
							'd.price' => 'price',
							'd.quantity'=>'quantity',
					));
				
			$select->where(array("od.orderId" => $orderIds));
			$selectString = $dbSql->getSqlStringForSqlObject($select);
		
			$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		
			if($results->count()) {
				foreach ($results as $row) {
					$orderDish = new \Admin\Model\OrderProduct();
					$orderDish->exchangeArray((array)$row);
					$dish = new \Admin\Model\Product();
					
					$dish->setName($row['d.name']);
					$dish->setPrice($row['d.price']);
					$quantity = ($dish->getQuantity() - $orderDish->getQuantity());
				//	$rs[$orderDish->getOrderId()]->qtt($dish->getQuantity() - $orderDish->getQuantity());
					$rs[$orderDish->getOrderId()]->addMoney($dish->getQuantity() * $orderDish->getQuantity());
// 					echo $dish->getQuantity();
// 					echo $orderDish->getQuantity();
					//echo $quantity;
					//$item->setQuantity($qtt);
					$orderDish->setProduct($dish);
					//$orderDish->setModifierName($row['md.name']);
					$proId[] = $orderDish->getProductId();
					
				}
				
			}
			$data = array(
					'quantity'=>$item->getQuantity()
			);
			$update = $dbSql->update('products');
			$update->set($data);
			$update->where(array(
					'id'=>$proId
			));
			$updateStr = $dbSql->getSqlStringForSqlObject($update);
			echo $updateStr;
			return $dbAdapter->query($updateStr,$dbAdapter::QUERY_MODE_EXECUTE);
		}
	}

	public function getOrder($id){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array('o'=> self::TABLE_NAME));
        $select->columns(array('orderId'));
        $select->where(array('o.orderId'=> $id));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        return $results->count();
	}

    /**
     * @param \Admin\Model\Order $model
     */
	public function save($model){
		$data = array(
			'orderId'=> $model->getOrderId(),
			'depotId'=> $model->getDepotId(),
			'depotName'=> $model->getDepotName(),
			'customerMobile'=> $model->getCustomerMobile(),
			'customerAddress'=> $model->getCustomerAddress(),
			'customerName'=> $model->getCustomerName(),
			'customerEmail'=> $model->getCustomerEmail(),
			'statusName'=> $model->getStatusName(),
			'statusCode'=> $model->getStatusCode(),
			'calcTotalMoney'=> $model->getCalcTotalMoney(),
			'createdDateTime'=> $model->getCreatedDateTime(),
		);
        $xss = new xssClean();
        $data = $xss->cleanInputs($data);

		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$orderId = $this->getOrder($data['orderId']);
		try {
            if(!$orderId){
                $insert = $dbSql->insert($this->getTableName());
                $insert->values($data);
                $query = $dbSql->getSqlStringForSqlObject($insert);
                $results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
//              $model->orderId($results->getGeneratedValue());
            } else {
                $update = $dbSql->update($this->getTableName());
                $update->set($data);
                $update->where(array("orderId" => (int)$model->getOrderId()));
                $selectString = $dbSql->getSqlStringForSqlObject($update);
                $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
            }
            return $results;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
	}

    /**
     * @param \Admin\Model\Order $item
     */

    public function delete($item){
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $select = $dbSql->delete($this->getTableName());
        $select->where(array('id'=> $item->getId()));
        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
    }


		
	
} 





















