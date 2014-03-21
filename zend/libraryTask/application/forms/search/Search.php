<?php

class Application_Form_Search_Search extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');		
		
		$this->addElement('text', 'value', array(
            'label'      => 'Value:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
		));

		$this->addSearchSelect();

		$this->addElement('submit', 'search', array(
            'ignore'   => true,
            'label'    => 'Search',        	
		));

		// And finally add some CSRF protection
		$this->addElement('hash', 'csrf', array(
            'ignore' => true,
		));
	}

	public function addSearchSelect()
	{
		$orderList = array(
     		'book' => 'book',
     		'author' => 'author',     
		 	'publisher' => 'publisher',
		 );

		 $orderFirst = $this->createElement('select','table',array(
      		 'Class' => 'combobox',
       		 'id' => 'orderfirst',
       		 'multiOptions' => $orderList,
       		 'decorators' => array('ViewHelper')
		 ));

		 $orderFirst->setRequired(false)
		 ->addValidator('InArray',false,array('haystack' => array_keys($orderList)));
		 	
		 $this->addElement($orderFirst);
	}
}