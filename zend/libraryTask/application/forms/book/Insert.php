<?php
 
class Application_Form_Book_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addElement('text', 'author_id', array(
            'label'      => 'Author:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'title', array(
            'label'      => 'Title:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'publisher_id', array(
            'label'      => 'Publisher:',        	
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'year', array(
            'label'      => 'Year:',        		
            'required'   => false,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'page_count', array(
            'label'      => 'Page count:',        		
            'required'   => false,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'receipt_date', array(
            'label'      => 'Receipt_date:',
        	'class'		 => 'datepicker',        	
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'genre_id', array(
            'label'      => 'Genre:',        		
            'required'   => false,
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