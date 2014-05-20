<?php

namespace Routes;

class Development extends \Core\Controller
{
	public function hello($name)
	{
		echo 'yay, ' . $name;
	}
}