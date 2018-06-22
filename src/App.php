<?php

class App extends \atk4\ui\App {
	public $auth;
	function __construct($is_admin = false) {
		
		parent::__construct('Money Lending');
		
		$this->dbConnect(isset($_ENV['CLEARDB_DATABASE_URL']) ? $_ENV['CLEARDB_DATABASE_URL']: 'mysql://money-lending:bMc9*9p0@sciretech.com:3306/money-lending');
		
		//Depending on the use, select appropriate layout for our pages
		if ($is_admin) {
			$this->initLayout('Admin');
			$this->layout->menuLeft->addItem(['Back', 'icon'=>'cog'], ['index']);
			$this->layout->menuLeft->addItem(['Admin', 'icon'=>'users'], ['admin']);

			$this->add(new \atk4\login\Auth())
				->setModel(new Model\Admin($this->db));
			
		} else {
			$this->initLayout('Centered');
			
			$this->auth = $this->add(new atk4\login\Auth([
				'check' =>false
			]));
			$this->auth->setModel(new Model\User($this->db));
		}
	}
}
