<?php

namespace Core;

class ControllerAdmin extends Controller
{
	public function __construct() 
	{
		\Lib\Auth::fastInitAdmin();
	}
}