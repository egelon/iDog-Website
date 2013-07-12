<?php
require_once('router\include.php');

class mainController
{
	private $model;

	public function getName()
    { 
        return get_class($this);
    }

    public function __construct(mainModel $model) 
    { 
        $this->model = $model; 
    }

    public function search()
    {
    	if(isset($_POST[dogId]))
    		$this->model->getDogCoordinates($_POST['dogId']);
    }

    public function add()
    {
        if(!empty($_POST))
            $this->model->addNewDog($_POST['name'], $_POST['gender'], $_POST['castrated'], $_POST['lat'], $_POST['lon']);
    }
}