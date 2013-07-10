<?php
require_once('router\include.php');

class adminLoginController
{
	private $model;

	public function getName()
    { 
        return get_class($this);
    }

    public function __construct(adminLoginModel $model) 
    { 
        $this->model = $model; 
    } 
}