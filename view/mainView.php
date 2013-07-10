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


		$searchForm = 
		'
			<section class="searchForm cf">
				<div id="message">meesaage</div>
				<form id = "publicSearchForm" name="search" action="" method="POST"> FIX IT
					<ul>
						<li>
							<label for="dogId">Dog ID:</label>
							<input type="number" name="dogId" id="dogId" class="text-input" placeholder="1234" required>
						</li>
						<li>
							<input type="submit" name="submit" class="button" value="Search" id="publicSearchButton">
						</li>
					</ul>
				</form>
			</section>
		';
		require_once($this->model->template);
	}
}