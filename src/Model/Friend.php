<?php

namespace Model;

class Friend extends \atk4\data\Model {
	public $table = 'friend';
	function init()	{
		parent::init();
		$this->addFields([
			['name', 'required'=>true],
			['email', 'required'=>true]
		]);
		$this->hasOne('user_id', new User());
	}
}