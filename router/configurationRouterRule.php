<?php
class ConfigurationRouterRule implements RouterRule 
{ 
    private $dice; 

    public function __construct(Dice $dice) 
	{ 
        $this->dice = $dice; 
    } 

    public function find(array $route) 
	{ 
        $name = '$route_' . $route[0] . '/' . $route[1]; 

        //If there is no special rule set up for this $name, revert to the default 
        if ($this->dice->getRule($name) == $this->dice->getRule('*')) 
		{ 
            return false; 
        } 
        else return $this->dice->create($name); 

    } 
}