<?php
require_once('model\model.php');
require_once('controller\controller.php');
require_once('view\view.php');
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
        $header = '<h1>First page test</h1>'; 
        return $header . '<div>' . $this->view->output() . '</div>'; 
    } 
} 