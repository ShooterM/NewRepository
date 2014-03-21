<?php
 
class Application_Form_Address_Update extends Zend_Form
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
        
        $this->addCountrySelect();

        $this->addElement('text', 'city', array(
            'label'      => 'City:',
        	'value'		 => $_GET['city'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'street', array(
            'label'      => 'Street:',
        	'value'		 => $_GET['street'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'home', array(
            'label'      => 'Home:',
        	'value'		 => $_GET['home'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'post_index', array(
            'label'      => 'Post index:',
        	'value'		 => $_GET['post_index'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        // add
        $this->addElement('submit', 'Ok', array(
            'ignore'   => true,
        	'label'    => 'Ok',
        ));
        
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
    
	public function addCountrySelect()
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