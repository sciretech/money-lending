<?php

namespace Model;
use \Mailjet\Resources;
	

class User extends \atk4\data\Model {
	public $table = 'user';
	function init()	{
		parent::init();
		$this->addFields([
			['email', 'required'=>true],
			['name', 'required'=>true],
			['password', 'type'=>'password'],
			['is_confirmed', 'type'=>'boolean', 'system'=>true],
			['is_admin', 'type'=>'boolean']
		]);
		
		$ref = $this->hasMany('Friends', new Friend());
		$ref->addField('total_loan', ['aggregate'=>'sum', 'type'=>'money']);
	}
	
	function sendMailConfirmation () {

  $mj = new MailjetClient(getenv('9ad3ccd72335063167b05ea67b9c5bf5'), getenv('040169e7fad54c769d31d6c760edf9e0'),true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "ralf.weiher@gmx.net",
          'Name' => "ralf.weiher@gmx.net"
        ],
        'To' => [
          [
            'Email' => "ralf.weiher@gmx.ne",
            'Name' => "Ralf"
          ]
        ],
        'TemplateID' => 458987,
        'TemplateLanguage' => true,
        'Subject' => "Please confirm your email",
        'Variables' => json_decode('{
    "name": "buddy",
    "url": "http://www.google.com"
  }', true)
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());
	}
}