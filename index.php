<?php
require_once('router\router.php');
require_once('router\frontController.php');
/*
$model = new Model();
//It is important that the controller and the view share the model
$controller = new Controller($model);
$view = new View($controller, $model);

if(isset($_GET['action']) && !empty($_GET['action'])){
    $controller->{$_GET['action']}();
}

echo $view->output();
*/

$frontController = new FrontController(new Router, $_GET['route'], isset($_GET['action']) ? $_GET['action'] : null); 
echo $frontController->output();

?>