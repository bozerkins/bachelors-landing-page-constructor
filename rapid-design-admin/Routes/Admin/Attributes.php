<?php

namespace Routes\Admin;

class Attributes extends \Core\Controller
{
	public function index()
	{
		$page = new \Lib\Page();
		$page->header(array('title' => 'Attributes', 'menuItem' => 'Attributes'))->body('index')->footer()->render();
	}
}