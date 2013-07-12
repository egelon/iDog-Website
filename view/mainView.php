<?php
require_once('router\include.php');
require_once('router\route.php');

class mainView
{
	private $model; 
    private $route;

    public function __construct($route, mainModel $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    }

    public function output()
	{
		//variables here must be called the same as those in the template
		$mainText = $this->model->mainScreenText;
		$databaseReplyText = $this->model->databaseReply;


		$searchForm = 
		'
			<section class="searchForm cf">
				<form class = "searchform customform" name="search" action="index.php?route=main&action=search" method="POST">
					<ul>
						<li>
							<label for="dogId">Dog ID:</label>
							<input type="number" name="dogId" id="dogId" placeholder="1234" required>
						</li>
						<li>
							<input type="submit" name="submit" value="Search">
						</li>
						<li>
							<span class="databaseReply">'.$databaseReplyText.'</span>
						</li>
					</ul>
				</form>
			</section>
		';

		$loginForm = 
		'
			<section class="loginForm cf">
				<form class = "loginform customform" name="login" action="FIX IT" method="POST">
					<ul>
						<li>
							<label for="email">Dog ID:</label>
							<input type="text" name="email" id="emailField" placeholder="example@gmail.com" required>
						</li>

						<li>
							<label for="password">Dog ID:</label>
							<input type="password" name="password" id="passwordField" placeholder="password" required>
						</li>

						<li>
							<input type="submit" name="submit" value="Login">
						</li>
						
						<li>
						<a href="FIX IT">Register</a>
						</li>

					</ul>
				</form>
			</section>
		';
		require_once($this->model->template);
	}
}