<?php
require_once('router\include.php');

class registrationController
{
	private $model;

	public function getName()
    { 
        return get_class($this);
    }

    public function __construct(registrationModel $model) 
    { 
        $this->model = $model; 
    } 
}