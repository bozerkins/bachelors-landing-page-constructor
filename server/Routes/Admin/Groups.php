<?php

namespace Routes\Admin;

class Groups extends \Core\ControllerAdmin
{
	public function index()
	{
		$model = new \Mdl\Group();
		$list = $model->all();
		$page = new \Lib\Page();
		$page->header(array('title' => 'Groups', 'menuItem' => 'Groups'))->body('Admin/Groups/index', array(
			'list' => $list,
			'base_url_segment' => 'admin/elements/view/',
			'base_url_segment_add' => 'admin/groups/add',
			'base_url_segment_delete' => 'admin/groups/delete/',
		))->footer()->render();
	}
	
	public function add()
	{
		$data = array();
		$data['title'] = array_key_exists('title', $_POST) && preg_match("/^[a-zA-Z\s0-9\-]+$/", $_POST['title']) ? $_POST['title'] : NULL;
		
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
		
		$model = new \Mdl\Group();
		$model->insert($data);
		$page->addSuccess('Record added');
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function delete($id)
	{
		$id = intval($id);
		$model = new \Mdl\Group();
		$model->delete($id);
		
		$page = new \Lib\Page();
		$page->addSuccess('Record successfully deleted');
		\Helpers\Url::redirectBack();
		return;
	}
}