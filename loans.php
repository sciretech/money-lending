<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';

$app = new App();

if (!$app->auth->user->loaded()) {
  $app->redirect(['login']);
}

$col = $app->add('Columns');

$friend_id = $app->stickyGet('friend_id');
$friend = $app->auth->user->ref('Friends')->load($friend_id);

$c = $col->addColumn(4);
$friends = $c->add(['View', 'defaultTemplate'=>'./friends.html']);
$friends->template->set($friend);
$friends->template->del('button');

$buttons = $c->add(['ui'=>'fluid buttons']);
$buttons->add(['Button', null, 'primary basic', 'icon' => 'left arrow'])->link(['dashboard']);
$delete = $buttons->add(['Button', null, 'negative basic', 'icon' => 'trash'])->link(['dashboard']);

$delete->on('click', function() use($friend, $app) {
	$name = $friend['name'];
	$friend->delete();
	return $app->jsRedirect(['dashboard', 'message'=>'Friend'. $name.' was deleted.']);
});

//See lecture 23 how to code different without function:
//https://www.udemy.com/web-apps-with-php-and-atk/learn/v4/t/lecture/10687800?start=0

function addCol($col, $friend, $label, $action, $default=50) {
	$c = $col->addColumn(6);
	$c->add(['Header', $label]);
	$t = $c->add('Table');
	$t->setModel($friend->ref($label));
	
	$field = $c->add(['FormField\Money', $default, 'fluid']);
	$action = $field->addAction([$action, 'primary']);
	
	$action->on('click', function($js, $amount) use ($friend, $label) {
		
		$friend->ref($label)->save(['amount'=>$amount]);
				
		return $friend->app->jsRedirect([]);
	}, [$field->jsInput()->val()]);
}

addCol($col, $friend, 'Loans', 'Loan');
addCol($col, $friend, 'Repayments', 'Repay', $friend['owed']);

