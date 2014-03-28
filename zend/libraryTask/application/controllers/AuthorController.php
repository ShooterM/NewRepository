<?php

class AuthorController extends Zend_Controller_Action
{	
	public function indexAction()
	{
		$author = new Application_Model_Author();
		$form = new Application_Form_Search_Search();
		$this->view->form = $form;
		$this->view->entries = $author->selectAll($this->getRequest()->getParam('value'),
												  $this->getRequest()->getParam('order'));
	}
	
	public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Author_Insert();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Author($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;
    }
    
    public function updateAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Author_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Author($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
    
	public function deleteAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Author_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Author($form->getValues());
                $model->remove();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
}