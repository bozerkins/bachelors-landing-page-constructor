<?php

namespace Routes\Admin;

class Styles extends \Core\Controller
{
	public function index()
	{
		$page = new \Lib\Page();
		$page->header(array('title' => 'Styles', 'menuItem' => 'Styles'))->body('index')->footer()->render();
	}
}