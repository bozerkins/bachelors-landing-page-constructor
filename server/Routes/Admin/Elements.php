<?php

namespace Routes\Admin;

class Elements extends \Core\Controller
{
	public function index()
	{
		$mdlGroup = new \Mdl\Group();
		$mdlElement = new \Mdl\Element();
		$groups = $mdlGroup->all();
		foreach($groups as $item) {
			$item->elements = $mdlElement->all(array(
				'group_id' => $item->id,
			));
			if (!$item->elements) {
				$item->elements = array();
			}
		}
		$page = new \Lib\Page();
		$page->header(array('title' => 'Elements', 'menuItem' => 'Elements'))->body('Admin/Elements/index', array(
			'list' => $groups ?: array(),
			'base_url_segment_linking' => 'admin/linking/view/',
		))->footer()->render();
	}
	
	public function view($id)
	{
		$mdlGroup = new \Mdl\Group();
		$mdlElement = new \Mdl\Element();
		$groupRecord = $mdlGroup->one($id);
		$groupRecord && $list = $mdlElement->all(array(
			'group_id' => (int)$groupRecord->id,
		));
		if (!$groupRecord) {
			 $this->app->response->redirect(\Helpers\Url::getBaseUrl());
			 return;
		}
		
		$page = new \Lib\Page();
		$page->header(array('title' => 'Group: ' . $groupRecord->title, 'menuItem' => 'Groups'))->body('Admin/Groups/view', array(
			'group' => $groupRecord,
			'list' => $list ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/elements/add/',
			'base_url_segment_change' => \Helpers\Url::getBaseUrl() . '/admin/elements/change/',
		))->footer()->render();
	}
	
	public function add()
	{
		$data = array();
		$data['group_id'] = array_key_exists('group_id', $_POST) ? intval($_POST['group_id']) : NULL;
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		$data['tag'] = array_key_exists('tag', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['tag']) ? $_POST['tag'] : NULL;
		
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
		
		$mdlElement = new \Mdl\Element();
		$mdlElement->insert($data);
		$page->addSuccess('Record added');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function change($id)
	{
		$id = intval($id);
		$page = new \Lib\Page();
		$mdlElement = new \Mdl\Element();
		$record = $mdlElement->one($id);
		if (!$record){
			$page->addError('Invalid record - no such exists');
			\Helpers\Url::redirectBack();
			return;
		}
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		$data['tag'] = array_key_exists('tag', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['tag']) ? $_POST['tag'] : NULL;
		
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
		
		$mdlElement->update($id, $data);
		$page->addSuccess('Record saved');
		\Helpers\Url::redirectBack();
		return;
	}
}