<?php

class Application_Model_Publisher
{
	protected $_id;
	protected $_pub_name;
	protected $_address;
	protected $_editor_id;
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

	function setPub_name($pub_name)
	{
		$this->_pub_name = (string)$pub_name;
		return $this;
	}

	function getPub_name()
	{
		return $this->_pub_name;
	}

	function setAddress($address)
	{
		$this->_address = (int)$address;
		return $this;
	}

	function getAddress()
	{
		return $this->_address;
	}

	function setEditor_id($editor_id)
	{
		$this->_editor_id = (int)$editor_id;
		return $this;
	}

	function getEditor_id()
	{
		return $this->_editor_id;
	}

	public function setMapper($mapper)
	{
		$this->_mapper = $mapper;
		return $this;
	}

	public function getMapper()
	{
		if (null === $this->_mapper) {
			$this->setMapper(new Application_Model_PublisherMapper());
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

	public function fetchAll()
	{
		return $this->getMapper()->fetchAll();
	}
}