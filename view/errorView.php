<?php
//require_once('model\errorModel.php');
require_once('router\include.php');
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
		
		$errorMsg = 
		'
			<span id="errorText">
				It seems the page you requested could not be found :(<br>Try going somewhere else.
			</span>
			<br>
			<span id="errorBackLink">
				<a href="index.php">Go back</a>
			</span>
			
		';
		require_once($this->model->template);
	}
}