<?php
require_once('router\route.php');
class Router 
{ 
    private $table = array(); 
     
    public function __construct() 
	{
        //this is from the example tutorial, we must remove it later
        //$this->table['controller'] = new Route('Model', 'View', 'Controller');

        $this->table['error'] = new Route('errorModel', 'errorView', 'errorController');
        $this->table['administrator'] = new Route('adminLoginModel', 'adminLoginView', 'adminLoginController');

        $this->table['main'] = new Route('mainModel', 'mainView', 'mainController');
        
		// Add routes here
		//routes should be in the form:
		//$this->table['  THE_VALUE_OF_GET['route']   '] = new Route('Model_for_this_route', 'the_corresponding_View_for_the_model_and_the_route', 'and_their_corresponding_Controller');  
		
    } 
     
    public function getRoute($route) 
	{ 
        $route = strtolower($route); 

        //Return a default route if no route is found 
        if (!isset($this->table[$route]))
		{
            //this is from the tutorial example, we must remove it later
            //return $this->table['controller'];

            //return Not Found page
            return $this->table['error'];
        } 
         
        return $this->table[$route];         
    } 
}