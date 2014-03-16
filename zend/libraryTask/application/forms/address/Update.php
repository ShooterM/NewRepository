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
	    
	    $this->addElement('text', 'country_id', array(
            'label'      => 'Country id:',
	    	'value'		 => $_GET['country_id'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
	    
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
        
        $this->addElement('text', 'Post index', array(
            'label'      => 'Post_index:',
        	'value'		 => $_GET['post_index'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
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
}