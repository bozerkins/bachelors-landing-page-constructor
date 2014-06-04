<?php

namespace Routes\Admin;

class Overview extends \Core\ControllerAdmin
{
	public function index()
	{
		$page = new \Lib\Page();
		$page->header(array('title' => 'Overview', 'menuItem' => 'Overview'))->body('index')->footer()->render();
	}
}