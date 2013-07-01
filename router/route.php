<?php
class Route 
{
	private $view; 
    private $controller; 

    public function __construct(View $view, $controller = null) 
	{ 
        $this->view = $view; 
        $this->controller = $controller; 
    } 

    public function getView() 
	{ 
        return $this->view; 
    } 

    public function getController() 
	{ 
        return $this->controller; 
    } 
}