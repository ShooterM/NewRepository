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
        
        $this->addElement('text', 'country_id', array(
            'label'      => 'Country:',        	
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