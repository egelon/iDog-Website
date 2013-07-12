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
			<section class="cf">
				<form class = "addform" name="search" action="index.php?route=main&action=search" method="GET">
					<input type="hidden" name="route" value="main">
					<input type="hidden" name="action" value="search">
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
			<section class="cf">
				<form class = "addform" name="login" action="./register/user_login.php" method="POST">
					<ul>
						<li>
							<label for="email">E-mail:</label>
							<input type="text" name="email" id="emailField" placeholder="example@gmail.com" required>
						</li>

						<li>
							<label for="password">Password:</label>
							<input type="password" name="password" id="passwordField" placeholder="password" required>
						</li>

						<li>
							<input type="submit" name="submit" value="Login">
						</li>

						<li>
							<a href="index.php?route=registration" id="regButton">Register</a>
						</li>

					</ul>
				</form>

			</section>
		';

		$addNewDogForm = 
		'
			<section class="cf">
				<form enctype="multipart/form-data" class = "addform" name="search" action="index.php?route=main&action=add" method="POST">
					<ul>
						<li>
							<label for="name">Dog name:</label>
							<input type="text" name="name" placeholder="A name for the dog" required>
						</li>
						<li>
							<label for="gender">Dog gender:</label>
							<input type="text" name="gender" placeholder="M/F" required>
						</li>
						<li>
							<label for="castrated">Is the dog castrated:</label>
							<input type="text" name="castrated" placeholder="Y/N" required>
						</li>

						<li>
							<label for="lat">Current location (lat):</label>
							<input type="text" name="lat" placeholder="Latitude" required>
						</li>
						<li>
							<label for="lon">Current location (lon):</label>
							<input type="text" name="lon" placeholder="Longitude" required>
						</li>
						<li>
							<label for="picture">A picture of the dog:</label>
							<input type="file" name="picture">
						</li>
						<li>
							<input type="submit" name="submit" value="Add">
						</li>
						<li>
							<span class="databaseReply">'.$databaseReplyText.'</span>
						</li>
					</ul>
				</form>
			</section>
		';

		require_once($this->model->template);
	}
}