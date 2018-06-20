<?php

namespace Model;

class User extends \atk4\data\Model {
	public $table = 'user';
	function init()	{
		parent::init();
		$this->addFields([
			['email', 'required'=>true],
			['name', 'required'=>true],
			['password', 'type'=>'password'],
			['is_confirmed', 'type'=>'boolean'],
			['is_admin', 'type'=>'boolean']
		]);
	}
}