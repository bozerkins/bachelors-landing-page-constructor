<?php

namespace Core\Config;

class Controls extends General
{
	protected $storage = array(
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