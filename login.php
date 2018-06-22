<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';

$app = new App();


$app->add([new \atk4\login\LoginForm(), 'auth'=>$app->auth]);
