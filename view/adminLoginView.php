<?php
require_once('router\include.php');

require_once('router\route.php');

class adminLoginView
{
	private $model; 
    private $route;

    public function __construct($route, adminLoginModel $model) 
	{ 
        $this->route = $route; 
        $this->model = $model; 
    }

    public function output()
	{
		//variables here must be called the same as those in the template
		
		$adminLoginForm = 
		'
			<section class="loginform cf">
				<form name="login" action="index_submit" method="get" accept-charset="utf-8">
					<ul>
						<li>
							<label for="usermail">Email</label>
							<input type="email" name="usermail" placeholder="yourname@email.com" required>
						</li>
						<li>
							<label for="password">Password</label>
							<input type="password" name="password" placeholder="password" required></li>
						<li>
							<input type="submit" value="Login">
						</li>
					</ul>
				</form>
			</section>
		';
		require_once($this->model->template);
	}
}