<?php

namespace Lib;

class Ajax extends \Core\General
{
	protected $ajaxOptions = NULL;
	
	public function response($response = NULL)
	{
		$this->ajaxOptions = $response;
		return $this;
	}
	
	public function render()
	{
		$response = $this->app->response;
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Expires', 'Sat, 13 Jul 2000 00:00:00 GMT');
		$response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
		$response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
		$response->headers->set('Cache-Control', 'post-check=0, pre-check=0', FALSE);
		$response->headers->set('Pragma', 'no-cache');
		
		$response->body( json_encode($this->ajaxOptions) );
		return $this;
	}
}