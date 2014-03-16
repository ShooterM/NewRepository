<?php

class LibraryController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$library = new Application_Model_Library();
		$this->view->entries = $library->fetchAll();
	}
	
	public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Library_Library();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Library($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }
        $this->view->form = $form;
    }	
}