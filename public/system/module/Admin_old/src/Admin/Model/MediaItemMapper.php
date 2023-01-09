<?php
namespace Admin\Model;
use Base\Mapper\Base;
use \Base\XSS\xssClean;

class MediaItemMapper extends Base{
	
	protected $tableName = 'media_item';

    CONST TABLE_NAME = 'media_item';

	/**
	 * @param \Admin\Model\MediaItem $model
	 */
	public function save($model) {
		$data = array(
            'type' => $model->getType(),
            'fileItem' => $model->getFileItem(),
            'itemId' => $model->getItemId(),
            'sort' => $model->getSort(),
            'storeId' => $model->getStoreId(),
		);
        $xss = new xssClean();
        $data = $xss->cleanInputs($data);
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
        $insert = $dbSql->insert($this->getTableName());
        $insert->values($data);
        $query = $dbSql->getSqlStringForSqlObject($insert);
        $results = $dbAdapter->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
//        $model->setId($results->getGeneratedValue());

		return $results;
	}

	public function delete($item){
		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
	
		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $this->getServiceLocator()->get('dbSql');
		$dbAdapter = $this->getServiceLocator()->get('dbAdapter');
		$select = $dbSql->delete($this->getTableName());
		$select->where(array('id'=>$item->getId()));
		$selectStr = $dbSql->getSqlStringForSqlObject($select);
		return $dbAdapter->query($selectStr,$dbAdapter::QUERY_MODE_EXECUTE);
	}

    /**
     * @param \Admin\Model\MediaItem $item
     */

    public function fetchAll($item){

        $select = $this->getDbSql()->select(array('mi'=> self::TABLE_NAME));
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        if ($item->getItemId()){
            $select->where(['mi.itemId'=> $item->getItemId()]);
        }
        if ($item->getItemId()){
            $select->where(['mi.type'=> $item->getType()]);
        }
        if ($item->getStoreId()){
            $select->where(['mi.storeId'=> $item->getStoreId()]);
        }
        $select->order([ 'mi.sort' => 'ASC']);

        $query = $this->getDbSql()->getSqlStringForSqlObject($select);

        $rows = $this->getDbAdapter()->query($query, $dbAdapter::QUERY_MODE_EXECUTE);
        $result =[];
        if ($rows->count()){
            foreach ($rows as $row){
                $row = (array)$row;
                $mediaItem = new MediaItem();
                $mediaItem->exchangeArray($row);
                $result[] = $mediaItem;
            }

        }
        return $result;
    }

    /**
     * @author Mienlv
     * @param \Admin\Model\ArticleTag $item
     */
    public function deleteTaskTag($item){
        if(!$item){
            return false;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $delete = $this->getDbSql()->delete(self::TABLE_NAME);

        $delete->where(['type' => \Admin\Model\MediaItem::FILE_ARTICLE]);
        $delete->where(['itemId' => $item]);

        $query = $dbSql->getSqlStringForSqlObject($delete);
        $result = $dbAdapter->query($query,$dbAdapter::QUERY_MODE_EXECUTE);
        return $result;
    }

    public function deleteFileProduct($item){
        if(!$item){
            return false;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $delete = $this->getDbSql()->delete(self::TABLE_NAME);

        $delete->where(['type' => \Admin\Model\MediaItem::FILE_PRODUCT]);
        $delete->where(['itemId' => $item]);

        $query = $dbSql->getSqlStringForSqlObject($delete);
        $result = $dbAdapter->query($query,$dbAdapter::QUERY_MODE_EXECUTE);
        return $result;
    }


    public function deleteImageCategory($item){
        if(!$item){
            return false;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $delete = $this->getDbSql()->delete(self::TABLE_NAME);

        $delete->where(['type' => \Admin\Model\MediaItem::FILE_CATEGORY_PRODUCT]);
        $delete->where(['itemId' => $item]);

        $query = $dbSql->getSqlStringForSqlObject($delete);
        $result = $dbAdapter->query($query,$dbAdapter::QUERY_MODE_EXECUTE);
        return $result;
    }

    public function deleteBanner($item){
        if(!$item){
            return false;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $delete = $this->getDbSql()->delete(self::TABLE_NAME);

        $delete->where(['type' => \Admin\Model\MediaItem::FILE_BANNER]);
        $delete->where(['itemId' => $item]);

        $query = $dbSql->getSqlStringForSqlObject($delete);
        $result = $dbAdapter->query($query,$dbAdapter::QUERY_MODE_EXECUTE);
        return $result;
    }

    public function deleteType($item)
    {
        if(!$item->getType() || !$item->getItemId()){
            return null;
        }
        /* @var $dbAdapter \Zend\Db\Adapter\Adapter */
        $dbAdapter = $this->getServiceLocator()->get('dbAdapter');

        /* @var $dbSql \Zend\Db\Sql\Sql */
        $dbSql = $this->getServiceLocator()->get('dbSql');
        $delete = $this->getDbSql()->delete(self::TABLE_NAME);

        $delete->where(['type' => $item->getType()]);
        $delete->where(['itemId' => $item->getItemId()]);

        $query = $dbSql->getSqlStringForSqlObject($delete);
        $result = $dbAdapter->query($query,$dbAdapter::QUERY_MODE_EXECUTE);
        return $result;
    }
}






















