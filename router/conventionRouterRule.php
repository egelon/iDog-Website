<?php
class ConventionRouterRule implements RouterRule 
{ 

    private $dice; 

    public function __construct(Dice $dice) 
	{
        $this->dice = $dice; 
    } 

    public function find(array $route) 
	{ 
        //There's no manual configuration, fall back to the class naming convention approach
        $className = $route[0] . $route[1]; 

        $viewName = $className . 'View'; 

        //Any objects requested by both the controller and view need to be shared between them
        $shared = array(); 

        if (class_exists($viewName)) 
		{                  
                $view = $this->dice->create($viewName, array(), function($args) use (&$shared) { 
                    $shared = $args; 
                }); 
        } 
        else return false; 
             

        //E.g. "UserEditController" 
        $controllerName = $className . 'Controller'; 

        if (class_exists($controllerName))
		{
			$controller = $this->dice->create($controllerName); 
        }
		else
		{			
			$controller = null; 
		}
        return new Route($view, $controller);     
    } 
}