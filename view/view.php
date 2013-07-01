<?php
class View
{
    private $model;
    private $controller;
    
    public function __construct(Controller $controller,Model $model) 
	{
        $this->controller = $controller;
        $this->model = $model;
    }
    
    public function output()
	{
		//variables here must be called the same as those in the template
		
		//action=SOME_ACTION : SOME_ACTION must be the name of a function in the corresponding controller
		$data = '<p><a href="index.php?action=clicked"' . $this->model->text . '</a></p>';
		require_once($this->model->template);
	}
}