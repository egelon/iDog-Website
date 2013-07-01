<?php
class View
{
    private $model; 
    private $route; 
     
    public function __construct($route, Model $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    } 
     
    public function output() { 
        return '<a href="mvc2.php?route=' . $this->route . '&action=textclicked">' . $this->model->text . '</a>'; 
    } 
    
    public function output()
	{
		//variables here must be called the same as those in the template
		
		//action=SOME_ACTION : SOME_ACTION must be the name of a function in the corresponding controller
		$data = '<a href="mvc2.php?route=' . $this->route . '&action=textclicked">' . $this->model->text . '</a>';
		require_once($this->model->template);
	}
}