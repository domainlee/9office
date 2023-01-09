<?php
namespace Product\Model;

use Base\Mapper\Base;
class CategoryMapper extends Base{

	protected $tableName = 'product_categories';

    /**
     * @param \Product\Model\Category $category
     */
    public function get($category)
    {
//        $dbAdapter = $this->getDbSlaveAdapter();
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        $dbSql = $this->getDbSql();

        $select = $dbSql->select(['atCate' => $this->getTableName()]);
        if ($category->getId()) {
            $select->where(['id' => $category->getId()]);
        }
        $select->where(['atCate.status = ?' => Category::STATUS_ACTIVE]);
        $select->where(['atCate.storeId = ?' => $category->getStoreId()]);
        $selectStr = $dbSql->getSqlStringForSqlObject($select);

        $result = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);

        if (!$result->count()) {
            return null;
        }

        $category->exchangeArray((array)$result->current());
//        $category->setServiceLocator($this->getServiceLocator());

        if ($category->getOption('childs') && $category->getOption('childs') == true) {
            $category->setChilds($this->fetchTree($category));
        }

        return $category;
    }

	public function fetchTree($category){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		
 		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		
		$select = $dbSql->select(array('pc'=>$this->getTableName()));
		if($category->getStoreId()){
			$select->where(array('pc.storeId'=>$category->getStoreId()));
		}
		$select->where(array('pc.status'=> \Product\Model\Product::STATUS_ACTIVE));

//        $select->join(['mi' => 'media_item'], 'pc.id=mi.itemId',['fileItem']);
//        $select->where(['mi.type'=> 2]);
//        $select->join(['m' => 'media'], 'mi.fileItem=m.id', ['fileName']);
//        $select->group('pc.id');


        $selectStr = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);

		$categories = array();
		$cates = array();
		if(count($results)){
			foreach ($results as $rows){
				$model = new \Product\Model\Category();
				$model->exchangeArray((array)$rows);
				$categories[] = $model;
			}
			if ($category->getId()) {
                /* @var $c \Product\Model\Category */
                /* @var $subC \Product\Model\Category */
                foreach ($categories as $c) {
                    foreach ($categories as $subC) {
                        if ($c->getId() === $subC->getParentId())
                            $c->addChild($subC);
                    }
                    if ($c->getParentId() == $category->getId())
                        $cates[] = $c;
                }
            } else {
                /* @var $c \Product\Model\Category */
                /* @var $subC \Product\Model\Category */
                foreach ($categories as $c) {
                    foreach ($categories as $subC) {
                        if ($c->getId() === $subC->getParentId())
                            $c->addChild($subC);
                    }
                    if (!$c->getParentId())
                        $cates[] = $c;
                }
            }
        }

        return $cates;
    }

    public function fetchAll($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("pc" => $this->getTableName()));

        if($item->getId()) {
            $select->where(array('pc.id' => $item->getId()));
        }
        if($item->getStoreId()){
            $select->where(array('pc.storeId' => $item->getStoreId()));
        }
        if($item->getParentId()){
            $select->where(array('pc.parentId' => $item->getParentId()));
        }
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $model = new \Admin\Model\Productc();
                $model->exchangeArray((array)$row);
                $rs[] = $model;
            }
        }
        return $rs;
    }
}