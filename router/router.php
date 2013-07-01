<?php
class Router 
{ 
    private $rules = array(); 
     
    public function addRule(RouterRule $rule) 
	{ 
        $this->rules[] = $rule; 
    } 
     
    public function getRoute(array $route) 
	{ 
        foreach ($this->rules as $rule) 
		{ 
            if ($found = $rule->find($route)) return $found;     
        } 
         
        throw new Exception('No matching route found'); 
    } 
}