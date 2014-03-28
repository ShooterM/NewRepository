<?php

class PublisherController extends Zend_Controller_Action
{	
	public function indexAction()
	{
		$publisher = new Application_Model_Publisher();
		$form = new Application_Form_Search_Search();
		$this->view->form = $form;
		$this->view->entries = $publisher->selectAll($this->getRequest()->getParam('value'),
													 $this->getRequest()->getParam('order'));
	}
	
	public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Publisher_Insert();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Publisher($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;
    }
    
    public function updateAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Publisher_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Publisher($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
    
	public function deleteAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Publisher_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Publisher($form->getValues());
                $model->remove();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
}