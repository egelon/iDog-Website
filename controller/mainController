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
}