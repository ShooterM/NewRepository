<?php

class SearchController extends Zend_Controller_Action
{

	public function indexAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Search_Search();
        /*if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Search($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');                
            }
        }*/
        $this->view->form = $form;
    }


}

