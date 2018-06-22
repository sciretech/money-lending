<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';

$app = new App();
$layout = $app->add('Columns');

$c1 = $layout->addColumn(4);
$c3 = $layout->addColumn(8);
$c2 = $layout->addColumn(4);

$m = $c1->add(['Menu', 'vertical fluid']);
$m->addItem('User Login', ['login']);
$m->addItem('Admin', ['admin']);

$c2->add(['Image', 'images/money.png']);$m->addItem('New User Register', ['register']);

$c3->add(['Message', 'About Money Lending App', 'info'])
	->text->addParagraph('Money lending is a great app when you need to keep tracking the money you have lent out to your friends.');