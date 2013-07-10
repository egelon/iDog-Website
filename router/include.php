<?php

$modelsFolder = 'model\\';
$viewsFolder = 'view\\';
$controllersFolder = 'controller\\';

//require_once($modelsFolder . 'model.php');
//require_once($viewsFolder . 'view.php');
//require_once($controllersFolder . 'controller.php');

require_once($modelsFolder . 'errorModel.php');
require_once($viewsFolder . 'errorView.php');
require_once($controllersFolder . 'errorController.php');

require_once($modelsFolder . 'adminLoginModel.php');
require_once($viewsFolder . 'adminLoginView.php');
require_once($controllersFolder . 'adminLoginController.php');