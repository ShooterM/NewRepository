<?php
 
class Application_Form_Country_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addElement('text', 'country', array(
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