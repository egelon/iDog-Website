<?php
require_once('router\include.php');

class adminLoginModel
{
	public $template;

	public function __construct() 
	{
		$this->template = "templates/adminLoginTemplate.php";
    } 
}