<?php
require_once('model\errorModel.php');
require_once('router\route.php');
class errorView
{
    private $model; 
    private $route; 
     
    public function __construct($route, errorModel $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    }
    
    public function output()
	{
		//variables here must be called the same as those in the template
		
		//action=SOME_ACTION : SOME_ACTION must be the name of a function in the corresponding controller
		$data = '404 - The page you requested could not be found.<br><a href="index.php">Go back</a>';
		require_once($this->model->template);
	}
}