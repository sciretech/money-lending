<?php

namespace Model;

class Repayment extends \atk4\data\Model {
	public $table = 'repayment';
	function init()	{
		parent::init();
		$this->addFields([
			['date', 'type'=>'date', 'default'=>new \DateTime()],
			['amount', 'type'=>'money']
		]);
		$this->hasOne('friend_id', new Friend());
	}
}