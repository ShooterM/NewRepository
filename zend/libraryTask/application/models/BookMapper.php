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
    
	public function selectAll($filter = NULL, $order = NULL)
    {
        $sql = $this->getDbTable()->getAdapter()->select()
        			->from(array('b' => 'books'),
        				array(
        					'id',
        					'author_id',
        					'title',
        					'publisher_id',
        					'year',
        					'page_count',
        					'receipt_date',
        					'genre_id'
        				))
        			->join(array('g' => 'genres'), 'g.id = b.genre_id',array('genre'))
        			->join(array('a' => 'authors'), 'a.id = b.author_id', array('auth' => "CONCAT_WS(' ',name,surname)"))
        			->join(array('p' => 'publishers'),'p.id = b.publisher_id', array('pub_name'));
    	
        if ($filter != null && $filter != "") {
    		$sql->where("CONCAT_WS(' ', b.title) LIKE ?",'%'.$filter.'%');    		
    	}
    				
    	if ($order != null && $order != "") {
    		if ($order === "1") {
    			$sql->order(array('b.id'));
    		} else { 
    			$sql->order(array('b.title'));
    		}
    	}
        $resultSet = $this->getDbTable()->getAdapter()->fetchAll($sql);
        $entries   = array();
        foreach ($resultSet as $row) {
            $book = new Application_Model_Book();
            $book  	->setId($row['id'])
            		->setAuthor_id($row['author_id'])
               		->setTitle($row['title'])
               		->setReceipt_date($row['receipt_date'])
               		->setPublisher_id($row['publisher_id'])
               		->setGenre_id($row['genre_id'])
               		->setPage_count($row['page_count'])
               		->setYear($row['year'])
               		->setAuthor($row['auth'])
               		->setGenre($row['genre'])
               		->setPublisher($row['pub_name'])
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