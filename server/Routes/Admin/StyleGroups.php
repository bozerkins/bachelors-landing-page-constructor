<?php

namespace Routes\Admin;

class StyleGroups extends \Core\ControllerAdmin
{
	public function index()
	{
		$model = new \Mdl\StyleGroup();
		$list = $model->all();
		$page = new \Lib\Page();
		$page->header(array('title' => 'Style Groups', 'menuItem' => 'Style Groups'))->body('Admin/StyleGroups/index', array(
			'list' => $list ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/stylegroups/add/',
			'base_url_segment' => 'admin/styles/',
			'base_url_segment_delete' => \Helpers\Url::getBaseUrl() . '/admin/stylegroups/delete/',
		))->footer()->render();
	}
	
	public function add()
	{
		$mdlStyleGroup = new \Mdl\StyleGroup();
		$data = array();
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-\,]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		
		$page = new \Lib\Page();
		
		$errors = FALSE;
		if (!$data['title']) {
			$errors = TRUE;
			$page->addError('Field is invalid or not properly filled: <b>' . 'title' . '</b>(a-z, spaces, dash, commas, numbers)');
		}
		if ($errors) {
			\Helpers\Url::redirectBack();
			return;
		}
		
		$mdlStyleGroup->insert($data);
		$page->addSuccess('Record added');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function delete($id)
	{
		$id = intval($id);
		$model = new \Mdl\StyleGroup();
		$model->delete($id);
		
		$page = new \Lib\Page();
		$page->addSuccess('Record successfully deleted');
		\Helpers\Url::redirectBack();
		return;
	}
}