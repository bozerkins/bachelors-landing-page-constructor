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
function controlsFetchCollection()
{
	return array(
		array(
			'id' => 1,
			'title' => 'Select item',
			'action' => 'select',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
		array(
			'id' => 2,
			'title' => 'Add item',
			'action' => 'add',
			'forUsual' => 1,
			'forImmortal' => 1,
		),
		array(
			'id' => 3,
			'title' => 'Change item',
			'action' => 'change',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
		array(
			'id' => 4,
			'title' => 'Remove item',
			'action' => 'remove',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
	);
}
function elementGroupsFetchCollection(){
	return array(
		array(
			'id' => 1,
			'title' => 'containers',
			'elements' => elementsFetchCollection(1),
		),
		array(
			'id' => 2,
			'title' => 'elements',
			'elements' => elementsFetchCollection(2),
		),
		array(
			'id' => 3,
			'title' => 'interaction+presets',
			'elements' => elementsFetchCollection(3),
		),
	);
}
function elementGroupFetch($id){
	$arr = array_filter(elementGroupsFetchCollection(), function($item) use ($id){
		return $item['id'] === $id;
	});
	return array_pop($arr);
}
function elementsFetchCollection($groupId){
	$arr = array(
		array(
			'id' => 1,
			'title' => 'article',
			'attribute' => 'article',
			'group_id' => 1,
		),
		array(
			'id' => 2,
			'title' => 'aside',
			'attribute' => 'aside',
			'group_id' => 1,
		),
		array(
			'id' => 3,
			'title' => 'navigation',
			'attribute' => 'nav',
			'group_id' => 1,
		),
		array(
			'id' => 4,
			'title' => 'block',
			'attribute' => 'div',
			'group_id' => 1,
		),
		array(
			'id' => 5,
			'title' => 'header',
			'attribute' => 'header',
			'group_id' => 1,
		),
		array(
			'id' => 6,
			'title' => 'footer',
			'attribute' => 'footer',
			'group_id' => 1,
		),
		array(
			'id' => 7,
			'title' => 'link',
			'attribute' => 'a',
			'group_id' => 2,
		),
		array(
			'id' => 8,
			'title' => 'non-numbered list',
			'attribute' => 'ul',
			'group_id' => 2,
		),
		array(
			'id' => 9,
			'title' => 'numbered list',
			'attribute' => 'ol',
			'group_id' => 2,
		),
		array(
			'id' => 10,
			'title' => 'table',
			'attribute' => 'table',
			'group_id' => 2,
		),
		array(
			'id' => 11,
			'title' => 'highlight',
			'attribute' => 'h1-h6',
			'group_id' => 2,
		),
		array(
			'id' => 12,
			'title' => 'image',
			'attribute' => 'img',
			'group_id' => 2,
		),
		array(
			'id' => 13,
			'title' => 'label',
			'attribute' => 'label',
			'group_id' => 2,
		),
		array(
			'id' => 14,
			'title' => 'paragraph',
			'attribute' => 'p',
			'group_id' => 2,
		),
		array(
			'id' => 15,
			'title' => 'text',
			'attribute' => 'span',
			'group_id' => 2,
		),
		array(
			'id' => 16,
			'title' => 'form',
			'attribute' => 'form',
			'group_id' => 3,
		),
		array(
			'id' => 17,
			'title' => 'input',
			'attribute' => 'input',
			'group_id' => 3,
		),
		array(
			'id' => 18,
			'title' => 'select',
			'attribute' => 'select',
			'group_id' => 3,
		),
	);
	return array_values(array_filter($arr, function($item) use ($groupId){
		return $item['group_id'] == $groupId;
	}));
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
			displayJson(controlsFetchCollection());
		}
	}
}
if ($type === 'elementGroup') {
	if ($action === 'read') {
		if ($requirer === 'collection') {
			displayJson(elementGroupsFetchCollection());
		}
	}
}