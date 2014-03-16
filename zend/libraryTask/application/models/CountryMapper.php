<?php

class Application_Model_CountryMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Not correct data');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Country');
		}
		return $this->_dbTable;
	}

    public function save(Application_Model_Country $country)
    {
        $data = array(
            'country' => $country->getCountry(),
        );
		if (null === ($id = $country->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
    public function remove(Application_Model_Country $country)
    {
		if (null === ($id = $country->getId())) {
            unset($data['id']);
        } else {
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Country $country)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $country->setId($row->id)
                ->setCountry($row->country);
    }
    
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Country();
            $entry->setId($row->id)            
                  ->setCountry($row->country)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
}