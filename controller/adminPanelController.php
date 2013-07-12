<?php
require_once('router\include.php');

class adminPanelController
{
	private $model;

	public function getName()
    { 
        return get_class($this);
    }

    public function __construct(adminPanelModel $model) 
    { 
        $this->model = $model; 
    } 
}