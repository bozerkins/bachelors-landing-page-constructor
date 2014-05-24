<?php

namespace Helpers;

class Url extends \Core\General
{
	public static function getBaseUrl()
	{
		$scriptName = self::$app->environment()->offsetGet('SCRIPT_NAME');
		return $scriptName;
	}
	
	public static function redirectBack()
	{
		$url = self::$app->environment()->offsetGet('HTTP_REFERER');
		self::$app->redirect($url);
		return;
	}
}