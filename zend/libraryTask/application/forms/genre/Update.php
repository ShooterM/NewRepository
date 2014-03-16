<?php
 
class Application_Form_Genre_Update extends Zend_Form
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
	    
        $this->addElement('text', 'genre', array(
            'label'      => 'Genre:',
        	'value'		 => $_GET['genre'],
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