<?php

namespace Core\Config;

class Attributes extends General
{
	protected $storage = array(
		'types' => array(
			'Label',
			'InputType', 
			'ImageSource',
			'Text',
			'Target',
		),
	);
}