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
		$mainText = $this->model->mainScreenText;
		$databaseReplyText = $this->model->databaseReply;


		$registrationForm = 
		'
			<section class="registrationForm cf">
				<form class = "registrationform customform" name="registration" action="index.php?route=registration&action=registeruser" method="POST">
					<ul>		

						<li>
							<label for="email">Please enter valid email address:</label>
							<input type="text" name="email" id="emailField" placeholder="example@gmail.com" required>
						</li>

						<li>
							<label for="password">Enter password:</label>
							<input type="password" name="password" id="passwordField" placeholder="password" required>
						</li>

						<li>
							<label for="name">Please enter your name:</label>
							<input type="text" name="name" id="nameField" placeholder="Your name">
						</li>

						<li>
							<label for="phone">Please enter your phone:</label>
							<input type="text" name="phone" id="phoneField" placeholder="Your phone number:">
						</li>

						<li>
							<input type="submit" name="submit" value="Register">
						</li>
					</ul>
				</form>
			</section>
		';

		
		require_once($this->model->template);
	}
}