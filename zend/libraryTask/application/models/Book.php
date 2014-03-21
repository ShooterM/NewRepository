<?php

class Application_Model_Book
{
	protected $_id;
	protected $_author_id;
	protected $_author;
	protected $_title;
	protected $_year;
	protected $_publisher_id;
	protected $_publisher;
	protected $_page_count;
	protected $_receipt_date;
	protected $_genre_id;
	protected $_genre;
	protected $_mapper;

	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}

	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Bad propertie!');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Bad propertie!');
		}
		return $this->$method();
	}

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}

	function setId($id)
	{
		$this->_id = (int)$id;
		return $this;
	}

	function getId()
	{
		return $this->_id;
	}

	function setAuthor_id($author_id)
	{
		$this->_author_id = (int)$author_id;
		return $this;
	}

	function getAuthor_id()
	{
		return $this->_author_id;
	}

	function setAuthor($author)
	{
		$this->_author = (string)$author;
		return $this;
	}

	function getAuthor()
	{
		return $this->_author;
	}
	
	function setTitle($title)
	{
		$this->_title = (string)$title;
		return $this;
	}

	function getTitle()
	{
		return $this->_title;
	}

	public function setPublisher_id($publisher_id)
	{
		$this->_publisher_id = (int)$publisher_id;
		return $this;
	}

	function getPublisher_id()
	{
		return $this->_publisher_id;
	}

	public function setPublisher($publisher)
	{
		$this->_publisher = (string)$publisher;
		return $this;
	}

	function getPublisher()
	{
		return $this->_publisher;
	}
	
	function getReceipt_date()
	{
		return $this->_receipt_date;
	}

	function setReceipt_date($receipt_date)
	{
		$this->_receipt_date = $receipt_date;
		return $this;
	}

	function getYear()
	{
		return $this->_year;
	}

	function setYear($year)
	{
		$this->_year = (int)$year; 
		return $this;
	}

	function getPage_count()
	{
		return $this->_page_count;
	}

	function setPage_count($page_count)
	{
		$this->_page_count = (int)$page_count; 
		return $this;
	}

	function getGenre_id()
	{
		return $this->_genre_id;
	}

	function setGenre_id($genre_id)
	{
		$this->_genre_id = (int)$genre_id; 
		return $this;
	}
	
	function getGenre()
	{
		return $this->_genre;
	}

	function setGenre($genre)
	{
		$this->_genre = (string)$genre; 
		return $this;
	}
	
	public function setMapper($mapper)
	{
		$this->_mapper = $mapper;
		return $this;
	}

	public function getMapper()
	{
		if (null === $this->_mapper) {
			$this->setMapper(new Application_Model_BookMapper());
		}
		return $this->_mapper;
	}

	public function save()
	{
		$this->getMapper()->save($this);
	}

	public function remove()
	{
		$this->getMapper()->remove($this);
	}

	public function find($id)
	{
		$this->getMapper()->find($id, $this);
		return $this;

	}

	public function selectAll()
	{
		return $this->getMapper()->selectAll();
	}
	
	public function fetchOne($id)
	{
		return $this->getMapper()->fetchOne($id);
	}
	
	public function fetchAll()
	{
		return $this->getMapper()->fetchAll();
	}
}