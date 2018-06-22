<?php

namespace Model;

class Admin extends User {

	function init()	{
		parent::init();
		
		$this->addCondition('is_admin', true);
	}
}