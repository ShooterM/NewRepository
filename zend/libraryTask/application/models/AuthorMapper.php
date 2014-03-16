<?php

class Application_Model_AuthorMapper
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
			$this->setDbTable('Application_Model_DbTable_Author');
		}
		return $this->_dbTable;
	}

    public function save(Application_Model_Author $author)
    {
    	$death = null;
    	if(is_null($author->getDeath_date()))
    	{   
			$death='null';    		
    	}
        $data = array(
            'name' => $author->getName(),
        	'surname' => $author->getSurname(),
        	'birth_date' => $author->getBirth_date(),
        	'death_date' => $death, // $author->getDeath_date(),
        	'country_id' => $author->getCountry_id(),
        );
		if (null === ($id = $author->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
    public function remove(Application_Model_Author $author)
    {
		if (null === ($id = $author->getId())) {
            unset($data['id']);
        } else {
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Author $author)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $author->setId($row->id)
               ->setName($row->name)
               ->setSurname($row->surname)
               ->setBirth_date($row->birth_date)
               ->setDeath_date($row->death_date)
               ->setCountry_id($row->country_id);
    }
    
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $author = new Application_Model_Author();
            $author->setId($row->id)          
                   ->setName($row->name)
                   ->setSurname($row->surname)
                   ->setBirth_date($row->birth_date)
                   ->setDeath_date($row->death_date)
                   ->setCountry_id($row->country_id)
                   ->setMapper($this);
            $entries[] = $author;
        }
        return $entries;
    }
}