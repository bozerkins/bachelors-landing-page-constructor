<?php

namespace Routes\Admin;

class Elements extends \Core\Controller
{
	public function index()
	{
		$page = new \Lib\Page();
		$page->header(array('title' => 'Elements', 'menuItem' => 'Elements'))->body('index')->footer()->render();
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
		$page->header(array('title' => 'Elements', 'menuItem' => 'Elements'))->body('Admin/Groups/view', array(
			'group' => $groupRecord,
			'list' => $list ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/elements/add/',
			'base_url_segment_change' => \Helpers\Url::getBaseUrl() . '/admin/elements/change/',
		))->footer()->render();
	}
	
	public function add()
	{
		echo 'add';
	}
	
	public function change()
	{
		echo 'change';
	}
}