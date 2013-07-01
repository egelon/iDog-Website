<?php
$rule = new DiceRule; 
//It will be an instance of the Route object 
$rule->instanceOf = 'Route'; 
$rule->constructParams = array(new DiceInstance('DefaultView')); 

//Add a named instance for the fallback view: 
$dice->addRule('$route_default', $rule);