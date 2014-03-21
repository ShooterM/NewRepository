<?php

class SearchController extends Zend_Controller_Action
{

	public function indexAction()
	{
		$request = $this->getRequest();
		$form    = new Application_Form_Search_Search();
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost())
		{			
			if ($this->getRequest()->getParam('table','book') === 'book') {
				print '-= books =-';				
				$this->resultBookAction();				
				$this->_helper->redirector('resultBook');
			} else {
				if ($this->getRequest()->getParam('table','author') === 'author') {
					return $this->_helper->redirector('resultAuthor');
				} else {
					if ($this->getRequest()->getParam('table','publisher') === 'publisher') {
						return $this->_helper->redirector('resultPublisher');						
					}
				}
			}
		}
	}

	public function resultBookAction()
	{
		$value = $this->getRequest()->getParams('value');
		$model = new Application_Model_Book();
		$this->view->entries = $model->fetchOne($value);
	}

	public function resultAuthorAction()
	{
		$value = $this->getRequest()->getParams('value');
		$model = new Application_Model_Author();
		$this->view->entries = $model->fetchOne($value);
	}

	public function resultPublisherAction()
	{
		$value = $this->getRequest()->getParams('value');
		$model = new Application_Model_Publisher();
		$this->view->entries = $model->fetchOne($value);
	}

}

