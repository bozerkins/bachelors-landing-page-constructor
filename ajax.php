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
			'name' => 'Select item',
			'actions' => array(),
		),
		array(
			'id' => 2,
			'name' => 'Add item',
			'actions' => array(),
		),
		array(
			'id' => 3,
			'name' => 'Change item',
			'actions' => array(),
		),
		array(
			'id' => 4,
			'name' => 'Remove item',
			'actions' => array(),
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

if ($type === 'menu') {
	if ($action === 'read') {
		if ($requirer === 'collection') {
			displayJson(menuFetchCollection());
		}
	}
}