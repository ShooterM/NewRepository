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
			if ($this->getRequest()->getParams('table','book') === 'book') {
				$this-> resultBookAction();
				return $this->_helper->redirector('resultBook');
			} else {
				if ($this->getRequest()->getParams('table','author') === 'author') {
					return $this->_helper->redirector('resultAuthor');
				} else {
					if ($this->getRequest()->getParams('table','publisher') === 'publisher') {
						return $this->_helper->redirector('resultPublisher');
					}
				}
			}
		}
	}

	public function resultBookAction()
	{
		$value = $this->getRequest()->getParams('value',intval(0));
		$model = new Application_Model_Book();
		$this->view->entries = $model->fetchOne($value);
	}

	public function resultAuthorAction()
	{
		$value = $this->getRequest()->getParams('value',intval(0));
		$model = new Application_Model_Author();
		$this->view->entries = $model->fetchOne($value);
	}

	public function resultPublisherAction()
	{
		$value = $this->getRequest()->getParams('value',intval(0));
		$model = new Application_Model_Publisher();
		$this->view->entries = $model->fetchOne($value);
	}

}

