<?php

namespace Mdl\Attribute;

class ImageSource extends General
{
	public function validate($value)
	{
		return filter_var($value, FILTER_VALIDATE_URL);
	}
}