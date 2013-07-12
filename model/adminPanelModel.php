<?php
require_once('router\include.php');

class adminPanelModel
{
	public $template;

	public function __construct() 
	{
		$this->template = "templates/adminPanelTemplate.php";
    } 
}