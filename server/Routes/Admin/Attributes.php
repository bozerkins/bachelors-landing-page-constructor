<?php

namespace Routes\Admin;

class Attributes extends \Core\Controller
{
	public function index()
	{
		$mdlAttribute = new \Mdl\Attribute();
		$list = $mdlAttribute->all();
		$page = new \Lib\Page();
		$page->header(array('title' => 'Attributes', 'menuItem' => 'Attributes'))->body('Admin/Attributes/index', array(
			'list' => $list ?: array(),
			'types' => $mdlAttribute->types() ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/attributes/add/',
			'base_url_segment_change' => \Helpers\Url::getBaseUrl() . '/admin/attributes/change/',
		))->footer()->render();
	}
	
	public function add()
	{
		$mdlAttribute = new \Mdl\Attribute();
		$data = array();
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		$data['type'] = array_key_exists('type', $_POST) && in_array($_POST['type'], $mdlAttribute->types()) ? $_POST['type'] : NULL;
		$data['name'] = array_key_exists('name', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['name']) ? $_POST['name'] : NULL;
		
		$page = new \Lib\Page();
		
		$errors = FALSE;
		if (!$data['title']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'title' . '</b>(a-z, spaces, dash, numbers)');
		}
		if (!$data['type']) {
			$errors = TRUE;
			$page->addError('Invalid type passed');
		}
		if (!$data['name']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'name' . '</b>(a-z, spaces, dash, numbers)');
		}
		
		if ($errors) {
			\Helpers\Url::redirectBack();
			return;
		}
		
		$mdlAttribute->insert($data);
		$page->addSuccess('Record added');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function change($id)
	{
		$id = intval($id);
		$page = new \Lib\Page();
		$mdlAttribute = new \Mdl\Attribute();
		$record = $mdlAttribute->one($id);
		if (!$record){
			$page->addError('Invalid record - no such exists');
			\Helpers\Url::redirectBack();
			return;
		}
		
		$data = array();
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		$data['type'] = array_key_exists('type', $_POST) && in_array($_POST['type'], $mdlAttribute->types()) ? $_POST['type'] : NULL;
		$data['name'] = array_key_exists('name', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['name']) ? $_POST['name'] : NULL;
		
		$page = new \Lib\Page();
		
		$errors = FALSE;
		if (!$data['title']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'title' . '</b>(a-z, spaces, dash, numbers)');
		}
		if (!$data['type']) {
			$errors = TRUE;
			$page->addError('Invalid type passed');
		}
		if (!$data['name']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'name' . '</b>(a-z, spaces, dash, numbers)');
		}
		
		if ($errors) {
			\Helpers\Url::redirectBack();
			return;
		}
		
		$mdlAttribute->update($id, $data);
		$page->addSuccess('Record changed');
		\Helpers\Url::redirectBack();
		return;
	}
}