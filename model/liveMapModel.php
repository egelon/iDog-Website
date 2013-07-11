<?php
require_once('router\include.php');

class liveMapModel
{
	public $template;
	public $mainScreenText;
	public $dogID;
	public $geoCoordinates;

	public function __construct() 
	{
		$this->template = "templates/liveMapTemplate.php";

		$this->mainScreenText = "Dog location";

		if(!empty($_GET['id']))
		{
			$this->dogID = $_GET['id'];
		}

		if(!empty($_GET['data']))
		{
			$jsonString = $_GET['data'];	
		}
		$this->geoCoordinates = json_decode($jsonString);

		echo $this->dogID;
		echo $this->geoCoordinates;
    }
}