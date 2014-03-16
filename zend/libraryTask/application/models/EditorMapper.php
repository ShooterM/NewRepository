<?php

class Application_Model_EditorMapper
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
			$this->setDbTable('Application_Model_DbTable_Editor');
		}
		return $this->_dbTable;
	}

    public function save(Application_Model_Editor $editor)
    {
        $data = array(
            'name' => $editor->getName(),
        	'surname' => $editor->getSurname(),
        );
		if (null === ($id = $editor->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
    public function remove(Application_Model_Editor $editor)
    {
		if (null === ($id = $editor->getId())) {
            unset($data['id']);
        } else {
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Editor $editor)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $editor->setId($row->id)
                ->setName($row->name)
                ->setSurname($row->surname);
    }
    
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Editor();
            $entry->setId($row->id)          
                  ->setName($row->name)
                  ->setSurname($row->surname)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
}