<?php

namespace Routes\Admin;

class Linking extends \Core\Controller
{
	public function index()
	{
		$page = new \Lib\Page();
		$page->header(array('title' => 'Linking', 'menuItem' => 'Linking'))->body('index')->footer()->render();
	}
}