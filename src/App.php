<?php

class App extends \atk4\ui\App {
	function __construct($is_admin = false) {
		
		parent::__construct('Money Lending');
		
		//Depending on the use, select appropriate layout for our pages
		if ($is_admin) {
			$this->initLayout('Admin');
			$this->layout->menuLeft->addItem(['Dashboard', 'icon'=>'cog'], ['dashboard']);
			$this->layout->menuLeft->addItem(['Guest Admin', 'icon'=>'users'], ['admin']);
			$this->layout->menuLeft->addItem(['User registration', 'icon'=>'user'], ['index']);
		} else {
			$this->initLayout('Centered');
		}
		$this->dbConnect(isset($_ENV['CLEARDB_DATABASE_URL']) ? $_ENV['CLEARDB_DATABASE_URL']: 'mysql://money-lending:bMc9*9p0@sciretech.com:3306/money-lending');
	}
}
