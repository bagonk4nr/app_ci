<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index($param='', $param1='')
	{
		// print_r($param1. ' / '. $param); exit();
		$param1 = str_replace("\\", "/", $param1);
		$menu = json_decode($param, true);
		// print_r($param1);
		return view($param1, $menu);
	}

	//--------------------------------------------------------------------

}
