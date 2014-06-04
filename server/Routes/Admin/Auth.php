<?php

namespace Routes\Admin;

class Auth extends \Core\Controller
{
	public function index()
	{
		$authObject = new \Lib\Auth();
		$authObject->check() && $this->app->response->redirect(\Helpers\Url::getBaseUrl() . '/admin/groups');
		
		$this->app->render(
			'Admin/auth_form.php',
			array(
				'base_url' => \Helpers\Url::getBaseUrl(),
				'login_base_url' => 'admin/auth/login',
			)
		);
	}
	
	public function login()
	{
		$login = array_key_exists('login', $_POST) ? $_POST['login'] : NULL;
		$password = array_key_exists('password', $_POST) ? sha1($_POST['password']) : NULL;
		
		$clientArr = $this->app->environment()->config->get('auth.admin');
		$auth = FALSE;
		foreach($clientArr as $clientItem) {
			if ($login === $clientItem['login'] && $password === $clientItem['password']) {
				$auth = TRUE;
			}
		}
		if ($auth) {
			$authObject = new \Lib\Auth();
			$authObject->login('admin');
		}
		\Helpers\Url::redirectBack();
		return;
	}
	
	public function logout()
	{
		$authObject = new \Lib\Auth();
		$authObject->logout();
		$this->app->response->redirect(\Helpers\Url::getBaseUrl());
		return;
	}
}