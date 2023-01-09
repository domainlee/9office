<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;


class AttrMapper extends Base{

    CONST TABLE_NAME = 'product_attr';
    /**
     * @param \Admin\Model\Attr $item
     */
    public function get($item)
    {
        if(!$item->getId() && !$item->getName() && !$item->getStoreId() && !$item->getType()){
            return null;
        }
        $select = $this->getDbSql()->select(array('pa' => self::TABLE_NAME));
        if($item->getId()){
            $select->where(['pa.id' => $item->getId()]);
        }
        if($item->getType()){
            $select->where(['pa.type' => $item->getType()]);
        }
        if($item->getStoreId()){
            $select->where(['pa.storeId' => $item->getStoreId()]);
        }
        if($item->getName()){
            $select->where(['pa.name' => $item->getName()]);
        }
        if($item->getColorCode()) {
            $select->where(['pa.colorCode' => $item->getColorCode()]);
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
     * @param \Admin\Model\Attr $model
     */
    public function save($model) {
        $data = array(
            'type' => $model->getType(),
            'name'=> $model->getName(),
            'colorCode' => $model->getColorCode(),
            'storeId' => $model->getStoreId(),
        );

        $xss = new xssClean();
        $data = $xss->cleanInputs($data);

        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $results = false;
        if (null === ($id = $model->getId())) {
            $insert = $dbSql->insert(self::TABLE_NAME);
            $insert->values($data);
            $query = $dbSql->getSqlStringForSqlObject($insert);
            $results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
        } else {
            $update = $dbSql->update(self::TABLE_NAME);
            $update->set($data);
            $update->where(array("id" => (int)$model->getId()));
            $selectString = $dbSql->getSqlStringForSqlObject($update);
            $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
        }
        return $results;
    }

    /**
     * @param \Admin\Model\Attr $item
     */
    public function search($item, $paging){

        $dbSql = $this->getServiceLocator()->get('dbSql');
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        $select = $dbSql->select(array('pa'=>self::TABLE_NAME));
        $rCount = $dbSql->select(array('pa'=>self::TABLE_NAME),array('c'=>'count(id)'));

        if ($item->getId()) {
            $select->where(['pa.id' => $item->getId()]);
            $rCount->where(['pa.id' => $item->getId()]);
        }
        if ($item->getStoreId()) {
            $select->where(['pa.storeId' => $item->getStoreId()]);
            $rCount->where(['pa.storeId' => $item->getStoreId()]);
        }
        if ($item->getName()) {
            $select->where(['pa.name LIKE ?' => '%'. $item->getName() .'%']);
            $rCount->where(['pa.name LIKE ?' => '%'. $item->getName() .'%']);
        }
        $currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
        $limit = isset ( $paging [1] ) ? $paging [1] : 20;
        $offset = ($currentPage - 1) * $limit;

        $select->limit ( $limit );
        $select->offset ( $offset );
        $select->order(['pa.type' => 'DESC']);

        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
        $count = $dbAdapter->query($rCountStr,$dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if(count($results)){
            foreach ($results as $rows){
                $model = new \Admin\Model\Attr();
                $model->exchangeArray((array) $rows);
                $rs[] = $model;
            }
        }

        return new \Base\Dg\Paginator ( $count->count(), $rs, $paging, count ( $results ) );
    }

    public function fetchAll($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("p" => self::TABLE_NAME));
        if($item->getType()){
            $select->where(['p.type' => $item->getType()]);
        }
        if($item->getStoreId()){
            $select->where(['p.storeId' => $item->getStoreId()]);
        }
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $model = new \Admin\Model\Attr();
                $model->exchangeArray((array)$row);
                $rs[] = $model;
            }
        }
        return $rs;
    }

    /**
     * @param \Admin\Model\Attr $item
     */

    public function delete($item){
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $select = $dbSql->delete(self::TABLE_NAME);
        $select->where(array('id'=> $item->getId()));
        $select->where(array('storeId'=> $item->getStoreId()));
        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
    }

}