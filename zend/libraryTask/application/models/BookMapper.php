<?php

class Application_Model_BookMapper
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
			$this->setDbTable('Application_Model_DbTable_Book');
		}
		return $this->_dbTable;
	}

    public function save(Application_Model_Book $book)
    {

        $data = array(
            'author_id' 	=> $book->getAuthor_id(),
        	'title' 	 	=> $book->getTitle(),
        	'publisher_id'	=> $book->getPublisher_id(),
        	'receipt_date' 	=> $book->getReceipt_date(),
        	'year' 			=> $book->getYear(),
        	'page_count'	=> $book->getPage_count(),
        	'genre_id' 		=> $book->getGenre_id(),
        );
		if (null === ($id = $book->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
	
    public function remove(Application_Model_Book $book)
    {
		if (null === ($id = $book->getId())) {
            unset($data['id']);
        } else {
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Book $book)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $book  ->setId($row->id)
               ->setAuthor_id($row->author_id)
               ->setTitle($row->title)
               ->setReceipt_date($row->receipt_date)
               ->setPublisher_id($row->publisher_id)
               ->setGenre_id($row->genre_id)
               ->setPage_count($row->page_count)
               ->setYear($row->year);
    }

	public function fetchOne($id)
    {
        $resultSet = $this->getDbTable()->select()->from('books',array('id','title'))->where('id = ?', $id);
        $entries   = array();
        foreach ($resultSet as $row) {
            $book = new Application_Model_Book();
            $book  	->setId($row->id)
               		->setTitle($row->title)
               		->setMapper($this);
            $entries[] = $book;
        }
        return $entries;
    }
    
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $book = new Application_Model_Book();
            $book  	->setId($row->id)
            		->setAuthor_id($row->author_id)
               		->setTitle($row->title)
               		->setReceipt_date($row->receipt_date)
               		->setPublisher_id($row->publisher_id)
               		->setGenre_id($row->genre_id)
               		->setPage_count($row->page_count)
               		->setYear($row->year)
               		->setMapper($this);
            $entries[] = $book;
        }
        return $entries;
    }
}