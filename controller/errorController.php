<?php
require_once('model\errorModel.php');
class errorController
{
    private $model; 

    public function getName()
    { 
        return 'errorController';
    } 
     
    public function __construct(errorModel $model) 
    { 
        $this->model = $model; 
    } 
}