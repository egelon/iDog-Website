<?php
require_once('model\errorModel.php');
class errorController
{
    private $model; 

    public function getName() { 
        return 'errorController'; //In the real world this may well be get_class($this), and this method defined in a parent class. 
    } 
     
    public function __construct(errorModel $model) { 
        $this->model = $model; 
    } 

    public function textClicked() { 
        $this->model->text = 'Text Updated'; 
    }
}