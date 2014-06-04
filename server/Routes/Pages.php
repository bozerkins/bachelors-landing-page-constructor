<?php

namespace Routes;

class Pages extends \Core\ControllerClient
{
	public function index()
	{		
		$mdlPage = new \Mdl\Page();
		$list = $mdlPage->all() ?: array();
		foreach($list as &$item) {
			$item->hash = base64_encode($item->id . ',' . $item->name);
		}
		$page = new \Lib\UserPage();
		$page->header(array('title' => 'Rapid Deign - Pages'))->body('Client/Pages/index', array(
			'list' => $list,
			'base_url_segment_add' => 'add',
			'base_url_segment_change' => 'update/',
			'base_url_segment_delete' => 'delete/',
			'base_url_segment_view' => \Helpers\Url::getBaseUrl() . '/../../client/index.php?token=',
		))->footer()->render();
	}
	
	public function add()
	{
		$data = array();
		$data['name'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		
		$page = new \Lib\Page();
		
		$errors = FALSE;
		foreach($data as $field => $item) {
			if (!$item) {
				$page->addError('Field is invalid or not properly filled: <b>' . $field . '</b>(a-z, spaces, dash, numbers)');
				$errors = TRUE;
			}
		}
		
		if ($errors) {
			\Helpers\Url::redirectBack();
			return;
		}
		
		$mdlPage = new \Mdl\Page();
		$mdlPage->insert($data);
		$page->addSuccess('Record added');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function update($id)
	{
		$page = new \Lib\Page();
		
		$id = intval($id);
		$mdlPage = new \Mdl\Page();
		$record = $mdlPage->one($id);
		if (!$record){
			$page->addError('Invalid record - no such exists');
			\Helpers\Url::redirectBack();
			return;
		}
		
		$data = array();
		$data['name'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		
		
		$errors = FALSE;
		foreach($data as $field => $item) {
			if (!$item) {
				$page->addError('Field is invalid or not properly filled: <b>' . $field . '</b>(a-z, spaces, dash, numbers)');
				$errors = TRUE;
			}
		}
		
		if ($errors) {
			\Helpers\Url::redirectBack();
			return;
		}
		
		$mdlPage->update($id, $data);
		$page->addSuccess('Record changed');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function delete($id)
	{
		$id = intval($id);
		$mdlPage = new \Mdl\Page();
		$mdlPage->delete($id);
		
		$page = new \Lib\Page();
		$page->addSuccess('Record successfully deleted');
		\Helpers\Url::redirectBack();
		return;
		
	}
}