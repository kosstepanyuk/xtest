<?php

class Application_Model_EmployeeMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Employee');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Employee $employee)
	{
		$data = array(
				'FirstName' => $employee->getFirstName(),
				'LastName' => $employee->getLastName()
		);

		if (null === ($id = $employee->getId())) {
			unset($data['id']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}

	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach ($resultSet as $row) {
			$entry = new Application_Model_Employee();
			$entry->setId($row->Id)
			->setFirstName($row->FirstName)
			->setLastName($row->LastName);
			$entries[] = $entry;
		}
		return $entries;
	}

}

