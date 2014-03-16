<?php

class GenreController extends Zend_Controller_Action
{	
	public function indexAction()
	{
		$genre = new Application_Model_Genre();
		$this->view->entries = $genre->fetchAll();
	}
	
	public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Genre_Insert();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Genre($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;
    }
    
    public function updateAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Genre_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Genre($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
    
	public function deleteAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Genre_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Genre($form->getValues());
                $model->remove();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
}