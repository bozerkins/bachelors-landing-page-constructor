<?php

namespace Mdl\Attribute;

class Text extends General
{
	public function validate($value)
	{
		return (bool)$value;
	}
}