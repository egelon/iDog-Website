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
        $this->model->getDogInfo($this->model->data['id']);
    }
}