<?php

require_once '../vendor/autoload.php';
require 'config.php';
require 'helpers/functions.php';
require '../app/Core/Router.php';


// Index
Router::get('/', 'HomeController::index');

// Users


// Collections


// Tasks

Router::run();
