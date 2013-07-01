<?php
require 'dice.php'
class DefaultRouterRule implements RouterRule 
{ 
    private $dice; 

    public function __construct(Dice $dice) 
	{ 
        $this->dice = $dice; 
    } 

    public function find(array $route) 
	{ 
        return $this->dice->create('$route_default');     
    } 
}