<?php

$token = array_key_exists('token', $_GET) ? $_GET['token'] : NULL;
$tokenData = $token ? explode(',', base64_decode($token)) : array();
$pageId = array_key_exists(0, $tokenData) ? intval($tokenData[0]) : NULL;

if (!$token) {
	exit('No token passed');
}
if (!$tokenData) {
	exit('No token data passed');
}