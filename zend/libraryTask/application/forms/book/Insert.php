<?php
 
class Application_Form_Book_Insert extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
    	
    	$this->addSelect("author");

        $this->addElement('text', 'title', array(
            'label'      => 'Title:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));

        $this->addSelect("publisher");
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

        $this->addSelect("genre");
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