<?php
 
class Application_Form_Publisher_Insert extends Zend_Form
{
    public function init()
    {
	    $this->setMethod('post');

        $this->addElement('text', 'pub_name', array(
            'label'      => 'Publisher:',
            'required'   => true,
            'filters'    => array('StringTrim'),            
        ));

        $this->addSelect("address");
        
        $this->addSelect("editor");
        
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
		if ($table === "address") {
			$address = new Application_Model_Address();
			$orderList = $address->returnArray();
			$selectName = "address";
		} else {
			$editor = new Application_Model_Editor();
			$orderList = $editor->returnArray();
			$selectName = "editor_id";
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