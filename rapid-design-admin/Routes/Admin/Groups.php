<?php

namespace Routes\Admin;

class Groups extends \Core\Controller
{
	public function index()
	{
		$model = new \Mdl\Group();
		$list = $model->all();
		$page = new \Lib\Page();
		$page->header(array('title' => 'Groups', 'menuItem' => 'Groups'))->body('Admin/Groups/index', array(
			'list' => $list,
			'base_url_segment' => 'admin/elements/view/',
		))->footer()->render();
	}
}