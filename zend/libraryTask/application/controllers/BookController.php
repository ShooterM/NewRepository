<?php

class BookController extends Zend_Controller_Action
{	
	public function indexAction()
	{
		$book = new Application_Model_Book();
		$this->view->entries = $book->fetchAll();
	}
	
	public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Book_Insert();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Book($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;
    }
    
    public function updateAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Book_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Book($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
    
	public function deleteAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Book_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Book($form->getValues());
                $model->remove();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
}