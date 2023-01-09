<?php
namespace Admin\Model;
use \Base\Mapper\Base;
use \Base\XSS\xssClean;
use Base\Dg\Paginator;
use \Home\Model\DateBase;

class ProductMapper extends Base{

	const TABLE_NAME = 'products';

	public function get($product){
        if(!$product->getId() && !$product->getTitle() && !$product->getCategoryId() && !$product->getStoreId()){
            return null;
        }
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array('p'=> self::TABLE_NAME));
        if($product->getId()){
		    $select->where(array('p.id'=> $product->getId()));
        }
        if($product->getTitle()){
            $select->where(['p.title LIKE ?' => $product->getTitle()]);
        }
        if($product->getCategoryId()){
            $select->where(array('p.categoryId'=> $product->getCategoryId()));
        }
        if($product->getStoreId()){
            $select->where(array('p.storeId'=> $product->getStoreId()));
        }
        if($product->getUrl()){
            $select->where(array('p.url'=> $product->getUrl()));
        }
        $selectStr = $dbSql->getSqlStringForSqlObject($select);

		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
		if(count($results)){
            $product->exchangeArray((array)$results->current());
            return $product;
		}
	}
	
    public function fetchAll($item)
	{
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');

		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$select = $dbSql->select(array("p" => self::TABLE_NAME));

        if($item->getStoreId()){
            $select->where(array('p.storeId'=> $item->getStoreId()));
        }
        if($item->getParentId()){
            $select->where(array('p.parentId'=> $item->getParentId()));
        }
        if($item->getTitle()){
            $select->where("p.title LIKE '%{$item->getTitle()}%'");
        }

		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
	
		$rs = array();
		if($results->count()) {
			foreach ($results as $row) {
				$model = new \Admin\Model\Product();
				$model->exchangeArray((array)$row);
				$rs[] = $model;
			}
		}
		return $rs;
	}
	
	public function save($model){
        $xss = new xssClean();
        $data = array(
            'categoryId' => $model->getCategoryId(),
            'storeId' => $model->getStoreId(),
            'parentId' => $model->getParentId(),
            'brandId' => $model->getBrandId(),
            'title' => $model->getTitle(),
            'type' => $model->getType(),
            'code' => $model->getCode(),
            'intro' => $model->getIntro(),
            'content' => $model->getContent(),
            'price' => $model->getPrice(),
            'priceOld' => $model->getPriceOld(),
            'quantity' => $model->getQuantity(),
            'status' => $model->getStatus(),
            'createdById' => $model->getCreatedById(),
            'createdDateTime' => $model->getCreatedDateTime(),
            'image' => $model->getImage(),
            'tags' => $model->getTags(),
            'metaTitle' => $model->getMetaTitle(),
            'metaKeyword' => $model->getMetaKeyword(),
            'metaDescription' => $model->getMetaDescription(),
            'productRelated' => $model->getProductRelated(),
            'articleRelated' => $model->getArticleRelated(),
            'view' => $model->getView(),
            'url' => $model->getUrl(),
            'extraContent' => $model->getExtraContent(),
		);
        $data = $xss->cleanInputs($data);
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		if(($id = $model->getId()) == null){
			$insert = $dbSql->insert(self::TABLE_NAME);
			$insert->values($data);
			$insertStr = $dbSql->getSqlStringForSqlObject($insert);
            $results = $dbAdapter->query($insertStr,$dbAdapter::QUERY_MODE_EXECUTE);
            $model->setId($results->getGeneratedValue());
        }
		else{
			$update = $dbSql->update(self::TABLE_NAME);
			$update->set($data);
			$update->where(array('id'=>$model->getId()));
			$updateStr = $dbSql->getSqlStringForSqlObject($update);
			return $dbAdapter->query($updateStr,$dbAdapter::QUERY_MODE_EXECUTE);
		}
	}

	
	public function search($item,$paging){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		$select = $dbSql->select(array('p'=>self::TABLE_NAME));
		$rCount = $dbSql->select(array('p'=>self::TABLE_NAME),array('c'=>'count(id)'));

		$select->join(array('pc' => 'product_categories'),
				'pc.id = p.categoryId',array(
						'cateName' => 'name'
				),\Zend\Db\Sql\Select::JOIN_LEFT
		);

        if($item->getId()){
			$select->where(array('p.id'=>$item->getId()));
			$rCount->where(array('p.id'=>$item->getId()));
		}
		if($item->getStoreId()){
			$select->where(array('p.storeId'=>$item->getStoreId()));
			$rCount->where(array('p.storeId'=>$item->getStoreId()));
		}
        if($item->getCategoryId()){
            $select->where(array('p.categoryId'=>$item->getCategoryId()));
            $rCount->where(array('p.categoryId'=>$item->getCategoryId()));
        }


        if($item->getOptions('keySearch')){
            $nameLike = '%' . $item->getTitle() . '%';
            $select->where(['(p.title LIKE ? OR p.content LIKE ?)' => [$nameLike, $nameLike]]);
            $rCount->where(['(p.title LIKE ? OR p.content LIKE ?)' => [$nameLike, $nameLike]]);
        } elseif($item->getTitle()){
            $name = htmlentities($item->getTitle());
            $select->where("p.title LIKE '%{$name}%'");
            $rCount->where("p.title LIKE '%{$name}%'");
        }

        if($item->getParentId()){
            $select->where(array('p.parentId'=>$item->getParentId()));
            $rCount->where(array('p.parentId'=>$item->getParentId()));
        } else {
            $select->where(array('p.parentId' => null));
            $rCount->where(array('p.parentId' => null));
        }

		$currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
		$limit = isset ( $paging [1] ) ? $paging [1] : 20;
		$offset = ($currentPage - 1) * $limit;
		$select->limit ( $limit );
		$select->offset ( $offset );
		$select->order ( 'p.id DESC' );

		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		$rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
		$count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);
		
		$rs = array();
		if(count($results)){
			foreach ($results as $rows){
				$model = new \Admin\Model\Product();
				$model->exchangeArray((array) $rows);
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
		$delete = $dbSql->delete(self::TABLE_NAME);
		$delete->where(array('id'=>$item->getId()));
		$deleteStr = $dbSql->getSqlStringForSqlObject($delete);
		return $dbAdapter->query($deleteStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}

    public function convertToKey($data){
        if(!$data){
            return null;
        }
        $result = [];
        foreach($data as $key => $val){
            $keyOut = '';
            switch (strtolower($key)){
                case 'tên sản phẩm':
                    $keyOut = 'title';
                    break;
                case 'mô tả':
                    $keyOut = 'intro';
                    break;
                case 'nội dung':
                    $keyOut = 'content';
                    break;
                case 'mã sản phẩm':
                    $keyOut = 'code';
                    break;
                case 'số lượng':
                    $keyOut = 'quantity';
                    break;
                case 'giá':
                    $keyOut = 'price';
                    break;
                case 'giá khuyến mãi':
                    $keyOut = 'priceOld';
                    break;
                case 'tên danh mục sản phẩm':
                    $keyOut = 'categoryId';
                    break;
                case 'tên thương hiệu':
                    $keyOut = 'brandId';
                    break;
                case 'tên file':
                    $keyOut = 'file';
                    break;
            }
            $result[$keyOut] = $val;
        }
        return $result;
    }

    public function related($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("p" => self::TABLE_NAME));

        if($item->getStoreId()){
            $select->where(array('p.storeId'=> $item->getStoreId()));
        }

        if($item->getTitle()){
            $select->where("p.title LIKE '%{$item->getTitle()}%'");
        }
        $select->limit (10);
        $select->order ( 'p.id DESC' );

        $selectString = $dbSql->getSqlStringForSqlObject($select);

        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $k => $row) {
                $model = new \Admin\Model\Product();
                $model->exchangeArray((array) $row);
                $rs[$k]['id'] = $row['id'];
                $rs[$k]['data-url'] = $model->getViewLink();
                $rs[$k]['text'] = $row['title'];
            }
        }
        return $rs;
    }

    public function fetchArray($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("p" => self::TABLE_NAME));

        if($item->getStoreId()){
            $select->where(array('p.storeId'=> $item->getStoreId()));
        }
        $select->order ( 'p.id DESC' );
        $select->where(array('p.parentId' => null));

        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $rs[$row['id']] = $row['title'];
            }
        }
        return $rs;
    }

    public function searchJson($item,$paging){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');

        $select = $dbSql->select(array('p'=>self::TABLE_NAME));
        $rCount = $dbSql->select(array('p'=>self::TABLE_NAME),array('c'=>'count(id)'));

        $select->join(array('pc' => 'product_categories'),
            'pc.id = p.categoryId',array(
                'cateName' => 'name'
            ),\Zend\Db\Sql\Select::JOIN_LEFT
        );

        if($item->getId()){
            $select->where(array('p.id'=>$item->getId()));
            $rCount->where(array('p.id'=>$item->getId()));
        }
        if($item->getStoreId()){
            $select->where(array('p.storeId'=>$item->getStoreId()));
            $rCount->where(array('p.storeId'=>$item->getStoreId()));
        }
        if($item->getCategoryId()){
            $select->where(array('p.categoryId'=>$item->getCategoryId()));
            $rCount->where(array('p.categoryId'=>$item->getCategoryId()));
        }


        if($item->getOptions('keySearch')){
            $nameLike = '%' . $item->getTitle() . '%';
            $select->where(['(p.title LIKE ? OR p.content LIKE ?)' => [$nameLike, $nameLike]]);
            $rCount->where(['(p.title LIKE ? OR p.content LIKE ?)' => [$nameLike, $nameLike]]);
        } elseif($item->getTitle()){
            $name = htmlentities($item->getTitle());
            $select->where("p.title LIKE '%{$name}%'");
            $rCount->where("p.title LIKE '%{$name}%'");
        }

        if($item->getParentId()){
            $select->where(array('p.parentId'=>$item->getParentId()));
            $rCount->where(array('p.parentId'=>$item->getParentId()));
        } else {
            $select->where(array('p.parentId' => null));
            $rCount->where(array('p.parentId' => null));
        }

        $currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
        $limit = isset ( $paging [1] ) ? $paging [1] : 20;
        $offset = ($currentPage - 1) * $limit;
        $select->limit ( $limit );
        $select->offset ( $offset );
        $select->order ( 'p.id DESC' );

        $selectStr = $dbSql->getSqlStringForSqlObject($select);
//		echo $selectStr;die;
        $rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if(count($results)){
            foreach ($results as $rows){
                $imageFirst = '';
                $i = json_decode($rows['image'], true);
                if(is_array($i) && !empty($i)) {
                    $imageFirst = array_shift($i);
                }
                $rs[] = array(
                    'id' => $rows['id'] ? $rows['id']:null,
                    'storeId' => $rows['storeId'] ? $rows['storeId']:null,
                    'code' => $rows['code'] ? $rows['code']:null,
                    'title' => $rows['title'] ? $rows['title']:null,
                    'price' => $rows['price'] ? $rows['price']:null,
                    'priceOld' => $rows['priceOld'] ? $rows['priceOld']:null,
                    'quantity' => $rows['quantity'] ? $rows['quantity']:null,
                    'img' => $imageFirst ? $imageFirst:null,

//                    $rows['id'] ? $rows['id']:null,
//                    $rows['storeId'] ? $rows['storeId']:null,
//                    $rows['code'] ? $rows['code']:null,
//                    $rows['title'] ? $rows['title']:null,
//                    $rows['price'] ? $rows['price']:null,
//                    $rows['priceOld'] ? $rows['priceOld']:null,
//                    $rows['quantity'] ? $rows['quantity']:null,
//                    $imageFirst ? $imageFirst:null,
                );
            }
        }
        return $rs;

    }


}




























