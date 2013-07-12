<?php
require_once('router\include.php');

require_once('router\route.php');

class registrationView
{
	private $model; 
    private $route;

    public function __construct($route, registrationModel $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    }

    public function output()
	{
		//variables here must be called the same as those in the template

		$mainText = "Fields, marked with * are required!";

		$registrationForm = 
		'
			<section class="cf">
				<form class="addform" name="register" action="index.php?route=registration&action=registeruser" method="post">
					<ul>
						<li>
							<label for="email">Email *</label>
							<input type="email" name="email" placeholder="yourname@email.com" required>
						</li>
						<li>
							<label for="password">Password *</label>
							<input type="password" name="password" placeholder="password" required></li>
						<li>
						<li>
							<label for="name">Name</label>
							<input type="text" name="name" placeholder="Your name"></li>
						<li>
						<li>
							<label for="phone">Phone number</label>
							<input type="text" name="phone" placeholder="Your phone number"></li>
						<li>
							<input type="submit" value="Register">
						</li>
					</ul>
				</form>
			</section>
		';
		require_once($this->model->template);
	}
}