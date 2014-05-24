<?php

namespace Routes\Ajax;

class Groups extends \Core\Controller
{
	public function read()
	{
		$mdlGroup = new \Mdl\Group();
		$mdlElement = new \Mdl\Element();
		$list = $mdlGroup->all() ?: array();
		foreach($list as $group) {
			$group->elements = $mdlElement->all(array(
				'group_id' => $group->id,
			));
		}
		$ajax = new \Lib\Ajax();
		$ajax->response($list)->render();
	}
}