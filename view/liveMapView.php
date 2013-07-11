<?php
require_once('router\include.php');

class liveMapView
{
	private $model; 
    private $route;

    public function __construct($route, liveMapModel $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    }

    public function output()
	{
		//variables here must be called the same as those in the template
		$mainText = $this->model->mainScreenText;
		

		require_once($this->model->template);
	}
}