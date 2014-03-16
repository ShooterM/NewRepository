<?php
 
class Application_Form_Publisher_Update extends Zend_Form
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
	    
        $this->addElement('text', 'pub_name', array(
            'label'      => 'Publisher:',
        	'value'		 => $_GET['pub_name'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'address', array(
            'label'      => 'Address:',
        	'value'		 => $_GET['address'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'editor_id', array(
            'label'      => 'Editor:',
        	'value'		 => $_GET['editor_id'],
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