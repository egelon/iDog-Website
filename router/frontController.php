<?php
require_once('include.php');

class FrontController 
{ 
    private $controller; 
    private $view; 
     
    public function __construct(Router $router, $routeName, $action = null) 
	{ 
        $route = $router->getRoute($routeName);

        $modelName = $route->model; 
        $controllerName = $route->controller; 
        $viewName = $route->view;
         
        $model = new $modelName; 
        $this->controller = new $controllerName($model); 
        $this->view = new $viewName($routeName, $model); 
         
         
        if (!empty($action))
		{
			$this->controller->{$action}(); 
		}
    } 
     
    public function output() 
	{ 
        //This allows for some consistent layout generation code  
        $header = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset=\'utf-8\'> 
                <title>Title of the document</title>

            </head>

        '; 
        return $header . $this->view->output() . '</html>'; 
    } 
} 