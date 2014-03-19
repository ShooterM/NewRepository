<?php

class Application_Model_PublisherMapper
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
			$this->setDbTable('Application_Model_DbTable_Publisher');
		}
		return $this->_dbTable;
	}

    public function save(Application_Model_Publisher $publisher)
    {
        $data = array(
            'pub_name' => $publisher->getPub_name(),
        	'address' => $publisher->getAddress(),
        	'editor_id' => $publisher->getEditor_id(),
        );
		if (null === ($id = $publisher->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
    public function remove(Application_Model_Publisher $publisher)
    {
		if (null === ($id = $publisher->getId())) {
            unset($data['id']);
        } else {
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Publisher $publisher)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $publisher->setId($row->id)
                ->setPub_name($row->pub_name)
                ->setAddress($row->address)
                ->setEditor_id($row->editor_id);
    }
    
	public function fetchOne($id)
    {
        $resultSet = $this->getDbTable()->select()->from('publishers',array('id','pub_name'))->where('id = ?', $id);
        $entries   = array();
        foreach ($resultSet as $row) {
            $publisher = new Application_Model_Publisher();
            $publisher->setId($row->id)          
                  	->setPub_name($row->pub_name)
                  	->setMapper($this);
            $entries[] = $publisher;
        }
        return $entries;
    }
    
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $publisher = new Application_Model_Publisher();
            $publisher->setId($row->id)          
                  	->setPub_name($row->pub_name)
                	->setAddress($row->address)
                	->setEditor_id($row->editor_id)
                  	->setMapper($this);
            $entries[] = $publisher;
        }
        return $entries;
    }
}