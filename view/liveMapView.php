<?php
require_once('router\include.php');
require_once('router\route.php');

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
		$id = $this->model->data['id'];
		$lat = $this->model->data['lat'];
		$lon = $this->model->data['lon'];

		$name = $this->model->dogName;
		$gender = $this->model->gender;
		$castrated = $this->model->castrated;
		$picture = $this->model->pictureURL;
		$addedBy = $this->model->addedBy;

		require_once($this->model->template);
	}
}