<?php
/**
 * @category   	Shop99 library
 * @copyright  	http://shop99.vn
 * @license    	http://shop99.vn/license
 */

namespace Uitemplate\Model;

use Base\Mapper\Base;

class UitemplateMapper extends Base {

	/**
	 * @var string
	 */
	protected $tableName = 'uitemplates';

    CONST TABLE_NAME = 'uitemplates';

	/**
	 * @param int $user
	 * @return User
	 */
	public function get($id) {
		$sl = $this->getServiceLocator();

		/* @var $dbAdapter \Zend\Db\Adapter\Adapter */
		$dbAdapter = $sl->get('dbAdapter');

		/* @var $dbSql \Zend\Db\Sql\Sql */
		$dbSql = $sl->get('dbSql');
		$select = $dbSql->select($this->getTableName());
		$select->where(array('id' => $id));
		$select->limit(1);

		$selectString = $dbSql->getSqlStringForSqlObject($select);
		$results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		if($results) {
			$uitemplate = new Uitemplate();
			return $uitemplate->exchangeArray((array)$results->current());
		}
		return null;
	}

    /**
     * @param \Uitemplate\Model\Uitemplate $item
     */

    public function getId($item)
    {
        if (!$item->getId() && !$item->getDirectory()) {
            return null;
        }
        $select = $this->getDbSql()->select(array('u' => $this->getTableName()));
        if($item->getId()) {
            $select->where(['u.id' => $item->getId()]);
        }
        if($item->getDirectory()) {
            $select->where(['u.directory' => $item->getDirectory()]);
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