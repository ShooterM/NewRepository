<?php
 
class Application_Form_Address_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

	    $this->addElement('text', 'country_id', array(
            'label'      => 'Country id:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
	    
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
}