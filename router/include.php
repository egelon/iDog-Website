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

require_once($modelsFolder . 'adminPanelModel.php');
require_once($viewsFolder . 'adminPanelView.php');
require_once($controllersFolder . 'adminPanelController.php');

require_once($modelsFolder . 'mainModel.php');
require_once($viewsFolder . 'mainView.php');
require_once($controllersFolder . 'mainController.php');

require_once($modelsFolder . 'liveMapModel.php');
require_once($viewsFolder . 'liveMapView.php');
require_once($controllersFolder . 'liveMapController.php');

