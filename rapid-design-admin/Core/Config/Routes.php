<?php

namespace Core\Config;

class Routes extends General
{
	protected $storage = array(
		'/hello/:name' => array(
			'Development',
			'hello',
		),
		'/' => array(
			'Admin.Overview',
			'index',
		),
		'/admin' => array(
			'Admin.Overview',
			'index',
		),
		'/admin/groups' => array(
			'Admin.Groups',
			'index',
		),
		'/admin/elements' => array(
			'Admin.Elements',
			'index',
		),
		'/admin/elements/view/:num' => array(
			'Admin.Elements',
			'view',
		),
		'/admin/elements/add/' => array(
			'Admin.Elements',
			'add',
			'post',
		),
		'/admin/elements/change/:num' => array(
			'Admin.Elements',
			'change',
			'post',
		),
		'/admin/attributes' => array(
			'Admin.Attributes',
			'index',
		),
		'/admin/attributes/add/' => array(
			'Admin.Attributes',
			'add',
			'post',
		),
		'/admin/attributes/change/:num' => array(
			'Admin.Attributes',
			'change',
			'post',
		),
		'/admin/styles' => array(
			'Admin.Styles',
			'index',
		),
		'/admin/attributes/add/' => array(
			'Admin.Attributes',
			'add',
			'post',
		),
		'/admin/attributes/change/:num' => array(
			'Admin.Attributes',
			'change',
			'post',
		),
		'/admin/linking' => array(
			'Admin.Linking',
			'index',
		),
	);
}