<?php
require_once('router\include.php');

class liveMapController
{
	private $model;

	public function getName()
    { 
        return get_class($this);
    }

    public function __construct(liveMapModel $model) 
    { 
        $this->model = $model; 
    }

    public function pin()
    {
    		echo $this->model->geoCoordinates;
    }
}