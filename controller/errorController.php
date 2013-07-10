<?php
//require_once('model\errorModel.php');
require_once('router\include.php');
class errorController
{
    private $model; 

    public function getName()
    { 
        //return 'errorController';
        return get_class($this);
    } 
     
    public function __construct(errorModel $model) 
    { 
        $this->model = $model; 
    } 
}