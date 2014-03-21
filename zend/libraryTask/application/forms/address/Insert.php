<?php
 
class Application_Form_Address_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addCountrySelect();
        
        $this->addElement('text', 'city', array(
            'label'      => 'City:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'street', array(
            'label'      => 'Street:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'home', array(
            'label'      => 'Home:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'post_index', array(
            'label'      => 'Post index:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
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