<?php
require_once('router\include.php');

class liveMapModel
{
	public $template;
	public $mainScreenText;

	public $data;

	public function __construct() 
	{
		$this->template = "templates/liveMapTemplate.php";

		$this->mainScreenText = "Dog location";

		if(!empty($_GET['data']))
		{
			$jsonString = $_GET['data'];	
		}

		$this->data = json_decode($jsonString);
    }
}