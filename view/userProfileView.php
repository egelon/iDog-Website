<?php
require_once('router\include.php');
require_once('router\route.php');

class userProfileView
{
	private $model; 
    private $route;

    public function __construct($route, userProfileModel $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    }

    public function output()
	{
		//variables here must be called the same as those in the template
		$mainText = $this->model->mainScreenText;
		$databaseReplyText = $this->model->databaseReply;
		$usersDogs = $this->model->dogsAdded;

		$updateForm = 
		'
			<section class="cf">
				<form class = "addform" name="update" action="index.php?route=profile&action=updateuser" method="POST">
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
							<input type="text" name="name" id="nameField" placeholder="Your name" required>
						</li>

						<li>
							<label for="phone">Please enter your phone:</label>
							<input type="text" name="phone" id="phoneField" placeholder="Your phone number" required>
						</li>

						<li>
							<input type="submit" name="submit" value="Update">
						</li>
					</ul>
				</form>
			</section>
		';

		require_once($this->model->template);
	}
}