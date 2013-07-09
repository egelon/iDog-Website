<?php
require_once('router\router.php');
require_once('router\frontController.php');

$frontController = new FrontController(new Router, $_GET['route'], isset($_GET['action']) ? $_GET['action'] : null); 
echo $frontController->output();

?>