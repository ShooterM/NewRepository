<?php
 
class Application_Form_Editor_Update extends Zend_Form
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