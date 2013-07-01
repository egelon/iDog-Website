<?php
class Controller
{
    private $model;
    public function __construct(Model $model)
	{
        $this->model = $model;
    }
    
    public function clicked()
	{
        $this->model->text = "link was clicked";
    }
}