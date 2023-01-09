<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class TemplateMapper extends Base{

    protected $tableName = 'uitemplates';

    /**
     * @param \Admin\Model\Template $item
     */
    public function get($item)
    {
        if(!$item->getId() && !$item->getName() && !$item->getDirectory()){
            return null;
        }
        $select = $this->getDbSql()->select(array('ui' => $this->getTableName()));
        if($item->getId()){
            $select->where(['ui.id' => $item->getId()]);
        }
        if($item->getName()){
            $select->where(['ui.name'=> $item->getName()]);
        }
        if($item->getDirectory()){
            $select->where(['ui.directory'=> $item->getDirectory()]);
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

    public function fetchAll($item)
    {
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("ui" => $this->getTableName()));

        $selectString = $dbSql->getSqlStringForSqlObject($select);

        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $row) {
                $model = new \Admin\Model\Template();
                $model->exchangeArray((array)$row);
                $rs[] = $model;
            }
            return $rs;
        }
        return null;
    }

    /**
     * @param \Admin\Model\Template $model
     */

    public function save($model) {

        $data = array(
            'name'=> $model->getName(),
            'directory'=> $model->getDirectory(),
        );
        $xss = new xssClean();
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

    /**
     * @param \Admin\Model\Template $model
     */
    public function search($item,$paging){
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array('ac'=>$this->getTableName()));
        $rCount = $dbSql->select(array('ac'=>$this->getTableName()),array('p'=>'count(id)'));

        if($item->getId()){
            $select->where(array('ac.id'=>$item->getId()));
            $rCount->where(array('ac.id'=>$item->getId()));
        }
        if($item->getName()){
            $select->where("ac.directory LIKE '%{$item->getName()}%'");
            $rCount->where("ac.directory LIKE '%{$item->getName()}%'");
        }
        $currentPage = isset ( $paging [0] ) ? $paging [0] : 1;
        $limit = isset ( $paging [1] ) ? $paging [1] : 20;
        $offset = ($currentPage - 1) * $limit;
        $select->limit ( $limit );
        $select->offset ( $offset );
        $select->order ( 'ac.id DESC' );

        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        $rCountStr = $dbSql->getSqlStringForSqlObject($rCount);
        $results = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);
        $count = $dbAdapter->query($rCountStr, $dbAdapter::QUERY_MODE_EXECUTE);
        $rs = array();
        if($results->count()){
            foreach ($results as $row){
                $model = new \Admin\Model\Template();
                $model->exchangeArray((array)$row);
                $rs[] = $model;
            }
        }
        return new \Base\Dg\Paginator($count->count(),$rs, $paging, count($results));
    }

    public function delete($item){
        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $select = $dbSql->delete($this->getTableName());
        $select->where(array('id'=>$item->getId()));
        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
    }

    /**
     * @param \Admin\Model\Template $item
     */
    public function related($item)
    {

        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("pc" => $this->getTableName()));

        if($item->getDirectory()){
            $select->where("pc.directory LIKE '%{$item->getDirectory()}%'");
        }
        if(!$item->getOptions('loadAll')) {
            $select->where(['pc.id NOT IN (4,15,36,37,29)']);
        }
        $select->limit (10);
        $select->order ( 'pc.id DESC' );
        $selectString = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        $rs = array();
        if($results->count()) {
            foreach ($results as $k => $row) {
                $rs[$k]['id'] = $row['id'];
                $rs[$k]['text'] = $row['directory'];
            }
        }
        return $rs;
    }


}






















