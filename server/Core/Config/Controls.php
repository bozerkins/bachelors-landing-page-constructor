<?php

namespace Core\Config;

class Controls extends General
{
	protected $storage = array(
		array(
			'id' => 1,
			'title' => 'Add',
			'action' => 'add',
			'forUsual' => 1,
			'forImmortal' => 1,
		),
		array(
			'id' => 2,
			'title' => 'Change',
			'action' => 'change',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
		array(
			'id' => 3,
			'title' => 'Remove',
			'action' => 'remove',
			'forUsual' => 1,
			'forImmortal' => 0,
			'delimiter' => 1,
		),
		array(
			'id' => 4,
			'title' => 'Copy',
			'action' => 'copy',
			'forUsual' => 1,
			'forImmortal' => 0,
		),
		array(
			'id' => 5,
			'title' => 'Paste',
			'action' => 'paste',
			'forUsual' => 1,
			'forImmortal' => 1,
			'delimiter' => 1,
		),
		array(
			'id' => 6,
			'title' => 'Tree View',
			'action' => 'display_tree',
			'forUsual' => 1,
			'forImmortal' => 1,
		),
		
	);
}