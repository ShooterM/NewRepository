<?php
 
class Application_Form_Search_Search extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addElement('text', 'pub_name', array(
            'label'      => 'Publisher:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));       
        
        // $this = new Zend_Form_Element_Select('table');
       
        $this->addElement('select','table',array(
        	'label'		 => 'Select some table',
        	'required'	 => true,
        	'options'  => array(
        						'author' 	=> 'author',
        						'publisher' => 'publisher',
        						'book'		=> 'book',
        						'address'	=> 'address',
        						'editor'	=> 'editor',
        						'genre'		=> 'genre',
        						'country'	=> 'country',
        				),
        ));
       
        $this->addElement('submit', 'Insert', array(
            'ignore'   => true,
            'label'    => 'Search',        	
        ));
        
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}