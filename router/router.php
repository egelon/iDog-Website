<?php
require_once('router\route.php');
class Router 
{ 
    private $table = array(); 
     
    public function __construct() 
	{
        $this->table['error'] = new Route('errorModel', 'errorView', 'errorController');
        $this->table['administrator'] = new Route('adminLoginModel', 'adminLoginView', 'adminLoginController');
        $this->table['adminpanel'] = new Route('adminPanelModel', 'adminPanelView', 'adminPanelController');

        //$this->table['livemap'] = new Route('liveMapModel', 'liveMapView', 'liveMapController');
        $this->table['main'] = new Route('mainModel', 'mainView', 'mainController');
        $this->table['livemap'] = new Route('liveMapModel', 'liveMapView', 'liveMapController');
        $this->table['registration'] = new Route('registrationModel', 'registrationView', 'registrationController');
        $this->table['profile'] = new Route('userProfileModel', 'userProfileView', 'userProfileController');
		// Add routes here
    } 
     
    public function getRoute($route) 
	{ 
        $route = strtolower($route); 

        //Return a default route if no route is found 
        if (!isset($this->table[$route]))
		{
            //return Not Found page
            return $this->table['error'];
        } 
         
        return $this->table[$route];         
    } 
}