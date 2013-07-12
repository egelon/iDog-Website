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

    public function registeruser()
    {
    	if (isset($_POST['email']) && isset($_POST['password']))
    		$this->model->registerUser($_POST['email'], $_POST['password'], $_POST['name'], $_POST['phone']);
    } 
}