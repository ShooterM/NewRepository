<?php

class EditorController extends Zend_Controller_Action
{	
	public function indexAction()
	{
		$editor = new Application_Model_Editor();
		$this->view->entries = $editor->fetchAll();
	}
	
	public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Editor_Insert();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Editor($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;
    }
    
    public function updateAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Editor_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Editor($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
    
	public function deleteAction(){
    	$request = $this->getRequest();
        $form    = new Application_Form_Editor_Update();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Editor($form->getValues());
                $model->remove();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;	    
    }
}