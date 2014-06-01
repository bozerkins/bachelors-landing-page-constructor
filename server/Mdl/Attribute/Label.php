<?php

namespace Mdl\Attribute;

class Label extends General
{
	public function validate($value)
	{
		return preg_match("/^[a-zA-Z0-9\s\-]+$/", $value);
	}
}