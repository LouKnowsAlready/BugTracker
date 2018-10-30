<?php


require 'core/App.php';
require 'core/Controller.php';
require 'core/Model.php';

// autoload models classes
spl_autoload_register(function($class){
	require_once "models/$class.php";;
});

