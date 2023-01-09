<?php
namespace Home\Model;
use \Base\Mapper\Base;
use \Base\XSS\xssClean;


class RegisterMapper extends Base{

    protected $tableName = 'register';

    /**
     * @param \Home\Model\Register $item
     */

    public function get($item)
    {
        if (!$item->getId() && !$item->getKeyActive()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('r' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['r.id' => $item->getId()]);
        }
        if($item->getKeyActive()) {
            $select->where(['r.keyActive' => $item->getKeyActive()]);
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
     * @param \Home\Model\Register $model
     */

    public function save($model) {
        $xss = new xssClean();

        $data = array(
            'keyActive' => $model->getKeyActive(),
            'createdDateTime'=> $model->getCreatedDateTime(),
            'data' => $model->getData(),
            'status' => $model->getStatus(),
        );

        $data = $xss->cleanInputs($data);
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        if (!$model->getId()) {
            $insert = $dbSql->insert($this->getTableName());
            $insert->values($data);
            $query = $dbSql->getSqlStringForSqlObject($insert);
            $results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
            $model->setId($results->getGeneratedValue());
        } else {
            $update = $dbSql->update($this->getTableName());
            $update->set($data);
            $update->where(array("id" => (int)$model->getId()));
            $selectString = $dbSql->getSqlStringForSqlObject($update);
            $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
        }
        return $results;
    }

    public function delete($item){
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $select = $dbSql->delete($this->getTableName());
        $select->where(array('id'=>$item->getId()));
        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
    }

}