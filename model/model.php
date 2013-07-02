<?php
class Model
{
    public $text;
    public $template;
	
    public function __construct() 
	{
		$this->text = "My model/'s string. Click it!";
		$this->template = "templates/template.php";
    }  
}