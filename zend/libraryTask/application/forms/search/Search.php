<?php

class Application_Form_Search_Search extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');		
		
		$this->addElement('text', 'value', array(
			'class'		 => 'text-search',
            'required'   => true,
            'filters'    => array('StringTrim'),            
		));
		
		$this->addElement('radio', 'order', array(
			'label' 	 => 'Order by: ',
			'class'		 => 'order-search',
			'multiOptions' => array(
				'1' => 'id',
				'2' => 'name'
			),			
		))->setDefault('order', '1');
		
		$this->addElement('submit', 'search', array(
			'class'		 => 'button-search',
            'ignore'   => true,
            'label'    => 'Search',        	
		));		

		// And finally add some CSRF protection
		$this->addElement('hash', 'csrf', array(
            'ignore' => true,
		));
	}
}