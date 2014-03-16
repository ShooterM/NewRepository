<?php
 
class Application_Form_Book_Update extends Zend_Form
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
	    
        $this->addElement('text', 'author_id', array(
            'label'      => 'Author:',
        	'value'		 => $_GET['author_id'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'title', array(
            'label'      => 'Title:',
        	'value'		 => $_GET['title'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'publisher_id', array(
            'label'      => 'Publisher:',
        	'value'		 => $_GET['publisher_id'],        	
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'year', array(
            'label'      => 'Year:',        
        	'value'		 => $_GET['year'],		
            'required'   => false,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'page_count', array(
            'label'      => 'Page count:',
        	'value'		 => $_GET['page_count'],        		
            'required'   => false,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'receipt_date', array(
            'label'      => 'Receipt_date:',
        	'value'		 => $_GET['receipt_date'],
        	'class'		 => 'datepicker',        	
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addElement('text', 'genre_id', array(
            'label'      => 'Genre:',        	
        	'value'		 => $_GET['genre_id'],	
            'required'   => false,
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