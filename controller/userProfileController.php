<?php
require_once('router\include.php');

class userProfileController
{
	private $model;

	public function getName()
    { 
        return get_class($this);
    }

    public function __construct(userProfileModel $model) 
    { 
        $this->model = $model; 
    }

    public function updateuser()
    {
    	$this->model->changeUserData($_POST['email'], $_POST['password'], $_POST['name'], $_POST['phone']);
    } 
}