<?php

namespace Home\Model;

use Base\Mapper\Base;

//use Home\Model\Base;

use Home\Model\BaseMapper;

Class ProductAttrListMapper extends Base
{
    /**
     * @var string
     */
    protected $tableName = 'product_attr_list';

    CONST TABLE_NAME = 'product_attr_list';

    /**
     * @param $item int
     * @return Home|null
     */
    public function get($item)
    {
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');
        $dbSql = $this->getDbSql();
        $select = $dbSql->select(['pal' => self::TABLE_NAME]);

//        $select->join(['pa' => 'product_attr'], 'pa.id=pal.productattrId');
        if($item->getStoreId()){
            $select->where(['pal.storeId' => $item->getStoreId()]);
        }
        if($item->getProductId()){
            $select->where(['pal.productId' => $item->getProductId()]);
        }
        if($item->getType()){
            $select->where(['pal.type' => $item->getType()]);
        }
        if($item->getOptions()['group']){
            $select->group('pal.productattrId');
        }
        $select->join(['pa' => 'product_attr'], 'pal.productattrId=pa.id',['name','colorCode']);
        $selectStr = $dbSql->getSqlStringForSqlObject($select);

        $result = $dbAdapter->query($selectStr, $dbAdapter::QUERY_MODE_EXECUTE);
        $rs = [];

        if ($result->count()) {
            foreach ($result as $row){
                $row = (array)$row;
                $ProductAttrList = new \Home\Model\ProductAttrList();
                $ProductAttrList->exchangeArray($row);
                $rs[] = $ProductAttrList;
            }
            return $rs;
        }
        return null;
    }

}