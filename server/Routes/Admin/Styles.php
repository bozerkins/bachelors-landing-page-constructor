<?php

namespace Routes\Admin;

class Styles extends \Core\Controller
{
	public function index()
	{
		$mdlStyle = new \Mdl\Style();
		$list = $mdlStyle->all();
		$page = new \Lib\Page();
		$page->header(array('title' => 'Styles', 'menuItem' => 'Styles'))->body('Admin/Styles/index', array(
			'list' => $list ?: array(),
			'types' => $mdlStyle->types() ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/styles/add/',
			'base_url_segment_change' => \Helpers\Url::getBaseUrl() . '/admin/styles/change/',
		))->footer()->render();
	}
	
	public function add()
	{
		$mdlStyle = new \Mdl\Style();
		$data = array();
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		$data['type'] = array_key_exists('type', $_POST) && is_array($_POST['type']) && $mdlStyle->hasTypesMatch($_POST['type']) ? $_POST['type'] : NULL;
		$data['name'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['name']) ? $_POST['name'] : NULL;
		
		$page = new \Lib\Page();
		
		$errors = FALSE;
		if (!$data['title']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'title' . '</b>(a-z, spaces, dash, numbers)');
		}
		if (!$data['type']) {
			$errors = TRUE;
			$page->addError('Invalid types passed');
		}
		if (!$data['title']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'name' . '</b>(a-z, spaces, dash, numbers)');
		}
		
		if ($errors) {
			\Helpers\Url::redirectBack();
			return;
		}
		
		$mdlStyle->insert($data);
		$page->addSuccess('Record added');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function change($id)
	{
		$id = intval($id);
		$page = new \Lib\Page();
		$mdlStyle = new \Mdl\Style();
		$record = $mdlStyle->one($id);
		if (!$record){
			$page->addError('Invalid record - no such exists');
			\Helpers\Url::redirectBack();
			return;
		}
		
		$data = array();
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		$data['type'] = array_key_exists('type', $_POST) && is_array($_POST['type']) && $mdlStyle->hasTypesMatch($_POST['type']) ? $_POST['type'] : NULL;
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
		
		$mdlStyle->update($id, $data);
		$page->addSuccess('Record changed');
		\Helpers\Url::redirectBack();
		return;
	}
}