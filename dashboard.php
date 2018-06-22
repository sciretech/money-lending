<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';

$app = new App();

if (!$app->auth->user->loaded()) {
  $app->redirect(['login']);
}

//$msg = $app->add(['Message', 'The money-lending-app dashboard is not in use yet.', 'info']);
//$msg->add('Text')->set($app->auth->user['email']);

//$modal = $app->add('Modal');
//$modal->add('LoremIpsum');
//$button->on('click', $modal->show());

$button = $app->add(['Button', 'Add a new friend', 'big primary']);

if (isset($_GET['message'])) {
	$msg = $app->add(['Message', $_GET['message'], 'red']);
	$msg->add(['View', 'Dismiss'])->link([]);
}

$modal = $app->add('Modal');
$button->on('click', $modal->show());


$friends = $app->add(['Lister', 'defaultTemplate'=>'./friends.html']);

$form = $modal->add('Form');
$form->setModel($app->auth->user->ref('Friends'));
$form->onSubmit(function($form) use($modal, $friends) {
	$form->model->save();
	return [
		$form->jsReload(),
		$friends->jsReload(),
		$modal->hide(),
	];
});

$friends->setModel($app->auth->user->ref('Friends'));

//$app->add('Table')->setModel(new Model\Friend($app->db));
//$table = $app->add('Table');
//$table->setModel($app->auth->user->ref('Friends'));
//$table->addDecorator('name', ['Link', ['loans'], ['friend_id'=>'id']]);

$app->add(['Button', 'Logout', 'primary', 'iconRight' => 'sign out'])->link(['logout']);