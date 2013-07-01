<?php
class Router
{
	private $dice //Dependency Injection ContainEr
	
	public function __construct(Dice $dice) 
	{ 
        $this->dice = $dice; 
    }

	public function find($route)
	{
		//Convert the parameter $route into a Route object as defined below
		//return new Route('...', '...', '...');
		
		//Split the parameter route on '/' so the first two parts can be extracted
		$routeParts = explode('/', $route);
		
		//A name based on the first two parts such as "UserEdit" or "UserList"
		//This name is the first part of the names of our views and controllers classes
		//for instance if the name is "UserEdit", we will have implemented 
		//	a View class, called UserEditView, 
		//and 
		//	a Controller class, called UserEditController
		$name = $routeParts[0] . $routeParts[1];
		
		//Any classes asked for by the view and the controller need to be shared between the two. 
		//These are likely models.
        $shared = array();
		
		//First we handle the View
		
		//The name of the associated View will be $name.'View'; for example: "UserEditView", or "UserListView"
		$viewName = $name . 'View';
		
		//Check to see if such a view exists
		if(class_exists($viewName))
		{
			//if it does, create that view with dice
			$view = $this->dice->create($viewName, array(), function($args) use (&$shared) {
                $shared = $args; 
            });
		}
		else
		{
			//if there is no such view, display an error
			//or load a default view or an error view
			//...or something
			$view = new DefaultView;
		}
		
		//View is done, now we handle the Controller for that View
		
		//E.g. "UserEditController"
		$controllerName = $name . 'Controller';
		
		//check to see if such a controller exists
		if(class_exists($controllerName))
		{
			//Create the controller and pass it any components that the view also asked for. 
			//This allows the Model to be shared between them both
            $controller = $this->dice->create($controllerName, $shared); 
		}
		else
		{
			$controller = null;
		}
		
		//At this point we have found and created our View and our Controller.
		//now we simply return them as fields of a Route object
		return new Route($view, $controller);
	}
}
