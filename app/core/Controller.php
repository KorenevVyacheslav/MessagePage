<?php
namespace App\core;

class Controller {
	
	public $model;
	public $view;

	function __construct()	{						
		$this->view = new View();				
	}
	
	public function action_index()	{}				//определим в дочерних классах


}






