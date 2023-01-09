<?php
namespace Home\Model;
use \Base\Mapper\Base;

class OptionMapper extends Base{

    protected $tableName = 'options';

    /**
     * @param \Home\Model\Option $item
     */

    public function get($item)
    {
        if (!$item->getId() && !$item->getStoreId()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('o' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['o.id' => $item->getId()]);
        }
        if($item->getStoreId()) {
            $select->where(['o.storeId' => $item->getStoreId()]);
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

}