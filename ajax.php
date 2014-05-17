<?php

function addHeaders()
{
	header('Content-Type: application/json');
}
function addHeadersNoCache()
{
	header('Expires: Sat, 13 Jul 2000 00:00:00 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');	
}
function menuFetchCollection()
{
	return array(
		array(
			'id' => 1,
			'title' => 'Select item',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
		array(
			'id' => 2,
			'title' => 'Add item',
			'forUsual' => 1,
			'forImmortal' => 1,
		),
		array(
			'id' => 3,
			'title' => 'Change item',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
		array(
			'id' => 4,
			'title' => 'Remove item',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
	);
}
function displayJson($result)
{
	print(json_encode($result));
}

addHeaders();
addHeadersNoCache();

$requirer = array_key_exists('requirer', $_GET) ? $_GET['requirer'] : NULL;
$action = array_key_exists('method', $_GET) ? $_GET['method'] : NULL;
$type = array_key_exists('type', $_GET) ? $_GET['type'] : NULL;

if ($type === 'control') {
	if ($action === 'read') {
		if ($requirer === 'collection') {
			displayJson(menuFetchCollection());
		}
	}
}