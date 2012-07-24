<?php

class EmployeeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_EmployeeMapper();
        $this->view->entries = $mapper->fetchAll();
    }


}

