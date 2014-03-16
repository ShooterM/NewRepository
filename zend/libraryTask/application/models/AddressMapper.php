<?php

class Application_Model_AddressMapper
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
			$this->setDbTable('Application_Model_DbTable_Address');
		}
		return $this->_dbTable;
	}

    public function save(Application_Model_Address $address)
    {
        $data = array(
            'country_id' => $address->getCountry_id(),
        	'city' => $address->getCity(),
        	'street' => $address->getStreet(),
        	'home' => $address->getHome(),
        	'post_index' => $address->getPost_index(),
        );
		if (null === ($id = $address->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
    public function remove(Application_Model_Address $address)
    {
		if (null === ($id = $address->getId())) {
            unset($data['id']);
        } else {
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Address $address)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $editor->setId($row->id)
                ->setCountry_id($row->country_id)
                ->setCity($row->city)
                ->setStreet($row->street)
                ->setHome($row->home)
                ->setPost_index($row->post_index);
    }
    
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Address();
            $entry->setId($row->id)
                  ->setCountry_id($row->country_id)
                  ->setCity($row->city)
                  ->setStreet($row->street)
                  ->setHome($row->home)
                  ->setPost_index($row->post_index)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
}