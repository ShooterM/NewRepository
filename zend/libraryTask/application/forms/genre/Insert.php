<?php
 
class Application_Form_Genre_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addElement('text', 'genre', array(
            'label'      => 'Genre:',
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