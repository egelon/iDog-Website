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
				<form id = "publicSearchForm" name="search" action="index.php?route=main&action=search" method="POST">
					<ul>
						<li>
							<label for="dogId">Dog ID:</label>
							<input type="number" name="dogId" id="dogId" placeholder="1234" required>
						</li>
						<li>
							<input type="submit" name="submit" value="Search">
						</li>
					</ul>
				</form>
			</section>
		';
		require_once($this->model->template);
	}
}