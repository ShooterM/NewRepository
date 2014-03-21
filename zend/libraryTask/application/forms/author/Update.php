<?php
 
class Application_Form_Author_Update extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');
	    
	    $this->addElement('text', 'id', array(
            'label'      => 'Id:',
	    	'value'		 => $_GET['id'], 
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
	    
        $this->addElement('text', 'name', array(
            'label'      => 'Name:',
        	'value'		 => $_GET['name'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'surname', array(
            'label'      => 'Surname:',
        	'value'		 => $_GET['surname'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'birth_date', array(
            'label'      => 'Birth date:',
        	'value'		 => $_GET['birth_date'],
        	'class'		 => 'datepicker',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'death_date', array(
            'label'      => 'Death date:',
        	'value'		 => $_GET['death_date'],
        	'class'		 => 'datepicker',	
            'required'   => false,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addSelect();
        
        // add
        $this->addElement('submit', 'Update', array(
            'ignore'   => true,
        	'label'    => 'Ok',
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