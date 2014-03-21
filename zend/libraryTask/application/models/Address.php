<?php

class Application_Model_Address
{
	protected $_id;
	protected $_country_id;
	protected $_country;
	protected $_city;
	protected $_street;
	protected $_home;
	protected $_post_index;
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

	function setCountry_id($country_id)
	{
		$this->_country_id = (int)$country_id;
		return $this;
	}

	function getCountry_id()
	{
		return $this->_country_id;
	}

	function setCountry($country)
	{
		$this->_country = (string)$country;
		return $this;
	}

	function getCountry()
	{
		return $this->_country;
	}
	
	function getCity()
	{
		return $this->_city;
	}

	function setCity($city)
	{
		$this->_city = (string)$city;
		return $this;
	}

	function getStreet()
	{
		return $this->_street;
	}

	function setStreet($street)
	{
		$this->_street = (string)$street;
		return $this;
	}

	function getHome()
	{
		return $this->_home;
	}

	function setHome($home)
	{
		$this->_home = (string)$home;
		return $this;
	}

	function getPost_index()
	{
		return $this->_post_index;
	}

	function setPost_index($post_index)
	{
		$this->_post_index = (int)$post_index;
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
			$this->setMapper(new Application_Model_AddressMapper());
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

	public function returnArray()
	{
		return $this->getMapper()->returnArray();
	}
	
	public function selectAll()
	{
		return $this->getMapper()->selectAll();
	}
	
	public function fetchAll()
	{
		return $this->getMapper()->fetchAll();
	}
}