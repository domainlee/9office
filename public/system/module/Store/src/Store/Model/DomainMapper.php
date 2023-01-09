<?php
/**
 * @category   	Shop99 library
 * @copyright  	http://shop99.vn
 * @license    	http://shop99.vn/license
 */

namespace Store\Model;

use Base\Mapper\Base;
use Zend\Db\Adapter\Adapter;
use \Base\XSS\xssClean;

class DomainMapper extends Base
{
	/**
	 * @var string
	 */
	protected $tableName = 'store_domains';

    CONST TABLE_NAME = 'store_domains';

	/**
	 * @param \Store\Model\Domain $domain
	 */
	public function get($domain)
	{
		$select = $this->getDbSql()->select($this->getTableName());
		if($domain->getName()){
		    $select->where(array('name' => $domain->getName(), 'alias' => $domain->getName()), "OR");
        }
        if($domain->getStoreId()) {
            $select->where(array('storeId' => $domain->getStoreId()));
        }
        if($domain->getUitemplate()) {
            $select->where(array('uitemplateId' => $domain->getUitemplate()));
        }
        $select->limit(1);

		$query = $this->getDbSql()->getSqlStringForSqlObject($select);
//        echo $query;die;
		$results = $this->getDbAdapter()->query($query, Adapter::QUERY_MODE_EXECUTE);

		if($results->count()) {
			$domain = $domain->exchangeArray((array)$results->current());
			return $domain;
		}
		return null;
	}

    /**
     * @param \Store\Model\Domain $domain
     */
    public function get2($domain)
    {
        $select = $this->getDbSql()->select($this->getTableName());
        if($domain->getName()){
            $select->where(array('name' => $domain->getName(), 'alias' => $domain->getName()), "OR");
        }
        if($domain->getStoreId()) {
            $select->where(array('storeId' => $domain->getStoreId()));
        }
        if($domain->getUitemplate()) {
            $select->where(array('uitemplateId' => $domain->getUitemplate()));
        }
        $select->limit(1);

        $query = $this->getDbSql()->getSqlStringForSqlObject($select);
        $results = $this->getDbAdapter()->query($query, Adapter::QUERY_MODE_EXECUTE);

        if($results->count()) {
            $domain = $domain->exchangeArray((array)$results->current());
            return $domain;
        }
        return null;
    }

    /**
     * @param \Store\Model\Domain $model
     */

    public function save($model) {
        $xss = new xssClean();
        $data = array(
            'storeId'=> $model->getStoreId(),
            'uitemplateId' => $model->getUitemplateId(),
            'parentStoreId' => $model->getParentStoreId(),
            'name' => $model->getName(),
            'alias' => $model->getAlias(),
            'description' => $model->getDescription(),
            'optionPage' => $model->getOptionPage(),
            'homePage' => $model->getHomePage(),
            'createdDateTime' => $model->getCreatedDateTime(),
        );

//        $data = $xss->cleanInputs($data);
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
            $update->where(array("storeId" => (int)$model->getStoreId()));
            $update->where(array("uitemplateId" => (int)$model->getUitemplateId()));
            $selectString = $dbSql->getSqlStringForSqlObject($update);
            $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
        }
        return $results;
    }

    public function save2($model) {
        $xss = new xssClean();
        $data = array(
            'storeId'=> $model->getStoreId(),
            'uitemplateId' => $model->getUitemplateId(),
            'name' => $model->getName(),
            'alias' => $model->getAlias(),
            'description' => $model->getDescription(),
            'optionPage' => $model->getOptionPage(),
            'createdDateTime' => $model->getCreatedDateTime(),
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
            $update->where(array("name" => $model->getName()));
//            $update->where(array("alias" => $model->getAlias()));
            $selectString = $dbSql->getSqlStringForSqlObject($update);
//            echo $selectString;die;
            $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
        }
        return $results;
    }

	/**
	 * @return array
	 */
	public function fetchInRoller()
	{
		$select = $this->getDbSql()->select($this->getTableName());
		$select->where(array('showInRoller' => '1'));

		$query = $this->getDbSql()->getSqlStringForSqlObject($select);
		$rows = $this->getDbAdapter()->query($query, Adapter::QUERY_MODE_EXECUTE);

		$domains = array();
		if ($rows->count()) {
			foreach ($rows as $row) {
 				$domain = new Domain();
 				$domains[] = $domain->exchangeArray((array)$row);
			}
			return $domains;
		}
        return null;
	}
}