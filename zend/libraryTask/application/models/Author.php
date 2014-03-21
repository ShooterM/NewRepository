<?php

class Application_Model_Author
{
	protected $_id;
	protected $_name;
	protected $_surname;
	protected $_birth_date;
	protected $_death_date;
	protected $_country_id;
	protected $_country;
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

	function setName($name)
	{
		$this->_name = (string)$name;
		return $this;
	}

	function getName()
	{
		return $this->_name;
	}

	function setSurname($surname)
	{
		$this->_surname = $surname;
		return $this;
	}

	function getSurname()
	{
		return $this->_surname;
	}

	public function setBirth_date($birth_date)
	{
		$this->_birth_date = $birth_date;
		return $this;
	}

	function getBirth_date()
	{
		return $this->_birth_date;
	}

	function getDeath_date()
	{
		return $this->_death_date;
	}

	function setDeath_date($death_date)
	{
		$this->_death_date = $death_date;
		return $this;
	}

	function getCountry_id()
	{
		return $this->_country_id;
	}

	function setCountry_id($country_id)
	{
		$this->_country_id = $country_id; 
		return $this;
	}

	function getCountry()
	{
		return $this->_country;
	}

	function setCountry($country)
	{
		$this->_country = $country; 
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
			$this->setMapper(new Application_Model_AuthorMapper());
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

	public function fetchOne($value)
	{
		return $this->getMapper()->fetchOne($value);
	}
	
	public function selectAll()
	{
		return $this->getMapper()->selectAll();
	}
	
	public function returnArray()
	{
		return $this->getMapper()->returnArray();
	}
	
	public function fetchAll()
	{
		return $this->getMapper()->fetchAll();
	}
}