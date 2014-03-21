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
	    
        $this->addSelect("author");
        
        $this->addElement('text', 'title', array(
            'label'      => 'Title:',
        	'value'		 => $_GET['title'],
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));
        
        $this->addSelect("publisher");
        
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
        
        $this->addSelect("genre");
        
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
    
	public function addSelect($table = null)
	{
		if ($table === "author") {
			$author = new Application_Model_Author();
			$orderList = $author->returnArray();
			$selectName = "author_id";
		} else {
			if ($table === "publisher") {
				$publisher = new Application_Model_Publisher();
				$orderList = $publisher->returnArray();
				$selectName = "publisher_id";
			} else {
				$genre = new Application_Model_Genre();
				$orderList = $genre->returnArray();
				$selectName = "genre_id";				
			}
		}
		$orderFirst = $this->createElement('select',$selectName,array(
       	'Class' => 'combobox',
       	'id' => 'orderfirst',
       	'multiOptions' => $orderList,
       	'decorators' => array('ViewHelper')
		));
		 	
		 $orderFirst->setRequired(false)
		 ->addValidator('InArray',false,array('haystack' => array_keys($orderList)));
		 	
		 $this->addElement($orderFirst);
	}
}