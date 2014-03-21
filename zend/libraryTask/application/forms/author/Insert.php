<?php
 
class Application_Form_Author_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addElement('text', 'name', array(
            'label'      => 'Name:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'surname', array(
            'label'      => 'Surname:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'birth_date', array(
            'label'      => 'Birth date:',
        	'class'		 => 'datepicker',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'death_date', array(
            'label'      => 'Death date:',
        	'class'		 => 'datepicker',	
            'required'   => false,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addSelect();

        // add
        $this->addElement('submit', 'Insert', array(
            'ignore'   => true,
            'label'    => 'Insert',
        ));
        
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
    
	public function addSelect()
	{
		$countries = new Application_Model_Country();
		$orderList = $countries->returnArray();
		 	
		$orderFirst = $this->createElement('select','country_id',array(
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