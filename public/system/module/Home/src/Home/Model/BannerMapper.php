<?php
namespace Home\Model;
use \Base\Mapper\Base;

class BannerMapper extends Base{

    protected $tableName = 'banners';

    public function fetchAll($banner){

        if(!$banner->getPositionId()){
            return null;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $select = $dbSql->select(array("b" => $this->getTableName()));
        if($banner->getId()){
            $select->where(array('b.id'=>$banner->getId()));
        }
        if($banner->getStoreId()){
            $select->where(array('b.storeId'=> $banner->getStoreId()));
        }
        $select->where(array('b.positionId'=> $banner->getPositionId()));

        $selectStr = $dbSql->getSqlStringForSqlObject($select);
        $results = $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
        $rs = array();
        if(count($results)){
            foreach ($results as $rows){
                $banner= new \Home\Model\Banner();
                $banner->exchangeArray((array)$rows);
                $rs[] = $banner;
            }
        }
        return $rs;
    }

}