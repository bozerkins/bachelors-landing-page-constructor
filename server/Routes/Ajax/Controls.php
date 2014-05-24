<?php

namespace Routes\Ajax;

class Controls extends \Core\Controller
{
	public function read()
	{
		$controls = $this->app->environment()->config->get('controls');
		
		$ajax = new \Lib\Ajax();
		$ajax->response($controls)->render();
	}
}