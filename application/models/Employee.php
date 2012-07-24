<?php

class Application_Model_Employee
{
	protected  $_id;
	protected  $_firstName;
	protected  $_lastName;

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
			throw new Exception('Invalid employee property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid employee property');
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
	
	public function getFirstName() {
		return $this->_firstName;
	}
	
	public function setFirstName($first) {
		$this->_firstName = $first;
		return $this;
	}
	
	public function getLastName() {
		return $this->_lastName;
	}
	
	public function setLastName($last) {
		$this->_lastName = $last;
		return $this;
	}
	
	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId()
	{
		return $this->_id;

	}
}


