<?php

namespace Lib;

class Auth extends \Core\General
{
	public function getLogin()
	{
		return ucfirst($_SESSION['auth']);
	}
	public function login($type)
	{
		$_SESSION['auth'] = $type;
		return $this;
	}
	
	public function check()
	{
		return array_key_exists('auth', $_SESSION);
	}
	
	public function logout()
	{
		if ($this->check()) {
			unset($_SESSION['auth']);
		}
	}
	
	public function isClient()
	{
		return $_SESSION['auth'] === 'client';
	}
	
	public function isAdmin()
	{
		return $_SESSION['auth'] === 'admin';
	}
	
	public static function fastInit()
	{
		$auth = new self();
		if (!$auth->check() || !$auth->isClient()) {
			$auth->app->response->redirect(\Helpers\Url::getBaseUrl());
			return FALSE;
		}
		return TRUE;
	}
	
	public static function fastInitAdmin()
	{
		$auth = new self();
		if (!$auth->check() || !$auth->isAdmin()) {
			$auth->app->response->redirect(\Helpers\Url::getBaseUrl() . '/admin/groups');
			return FALSE;
		}
		return TRUE;
	}
}