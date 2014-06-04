<?php

namespace Core\Config;

class Routes extends General
{
	protected $storage = array(
		// Authentication
		
		'/auth' => array(
			'Auth',
			'index',
		),
		'/auth/login' => array(
			'Auth',
			'login',
			'post',
		),
		'/auth/logout' => array(
			'Auth',
			'logout',
		),
		'/admin/auth' => array(
			'Admin.Auth',
			'index',
		),
		'/admin/auth/login' => array(
			'Admin.Auth',
			'login',
			'post',
		),
		
		// pages

		'/pages/' => array(
			'Pages',
			'index',
		),
		'/pages/add' => array(
			'Pages',
			'add',
			'post',
		),
		'/pages/update/:num' => array(
			'Pages',
			'update',
			'post',
		),
		'/pages/delete/:num' => array(
			'Pages',
			'delete',
		),
		
		// other
		
		'/sessionkeepup' => array(
			'SesKepUp',
			'index',
		),
		'/' => array(
			'Auth',
			'index',
		),
		'/admin' => array(
			'Admin.Auth',
			'index',
		),
		'/admin/groups' => array(
			'Admin.Groups',
			'index',
		),
		
		'/admin/groups/add' => array(
			'Admin.Groups',
			'add',
			'post'
		),
		'/admin/groups/delete/:num' => array(
			'Admin.Groups',
			'delete',
		),
		'/admin/stylegroups' => array(
			'Admin.StyleGroups',
			'index',
		),
		'/admin/stylegroups/add/' => array(
			'Admin.StyleGroups',
			'add',
			'post',
		),
		'/admin/stylegroups/delete/:num' => array(
			'Admin.StyleGroups',
			'delete',
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
		'/admin/elements/delete/:num' => array(
			'Admin.Elements',
			'delete',
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
		'/admin/attributes/delete/:num' => array(
			'Admin.Attributes',
			'delete',
		),
		'/admin/styles' => array(
			'Admin.Styles',
			'index',
		),
		'/admin/styles/:num' => array(
			'Admin.Styles',
			'index',
		),
		'/admin/styles/add/' => array(
			'Admin.Styles',
			'add',
			'post',
		),
		'/admin/styles/change/:num' => array(
			'Admin.Styles',
			'change',
			'post',
		),
		'/admin/styles/delete/:num' => array(
			'Admin.Styles',
			'delete',
		),
		'/admin/linking/view/:num' => array(
			'Admin.Linking',
			'view',
		),
		'/admin/linking/add/:num' => array(
			'Admin.Linking',
			'add',
			'post',
		),
		'/ajax/init/read' => array(
			'Ajax.Init',
			'read',
			'post',
		),
		'/ajax/tree/create' => array(
			'Ajax.Tree',
			'create',
			'post',
		),
		'/ajax/tree/attributes/update' => array(
			'Ajax.Tree.Attributes',
			'update',
			'post',
		),
		'/ajax/tree/styles/update' => array(
			'Ajax.Tree.Styles',
			'update',
			'post',
		),
		'/ajax/tree/delete' => array(
			'Ajax.Tree',
			'delete',
			'post',
		),
		'/ajax/tree/attributes/delete' => array(
			'Ajax.Tree.Attributes',
			'delete',
			'post',
		),
		'/ajax/tree/styles/delete' => array(
			'Ajax.Tree.Styles',
			'delete',
			'post',
		),
		'/ajax/tree/createClone' => array(
			'Ajax.Tree',
			'createClone',
			'post',
		),
		'/ajax/tree/attributes/validateCollection' => array(
			'Ajax.Tree.Attributes',
			'validateCollection',
			'post',
		),
		'/ajax/tree/styles/validateCollection' => array(
			'Ajax.Tree.Styles',
			'validateCollection',
			'post',
		),
	);
}