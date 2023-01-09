<?php
namespace Home\Model;

use Base\Mapper\Base;

class MenuMapper extends Base{

    protected $tableName = 'menu';

    /**
     * @param \Home\Model\Menu $item
     */

    public function get($item)
    {
        if (!$item->getId() && !$item->getStoreId()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('m' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['m.id' => $item->getId()]);
        }
        if($item->getStoreId()) {
            $select->where(['m.storeId' => $item->getStoreId()]);
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
     * @param \Home\Model\Menu $item
     */
    public function fetchAll($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("m" => $this->getTableName()));

        if($item->getStoreId()) {
            $select->where(array('m.storeId' => $item->getStoreId()));
        }

        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $model = new \Home\Model\Menu();
                $model->exchangeArray((array)$row);
                $rs[] = $model;
            }
        }
        return $rs;
    }

}