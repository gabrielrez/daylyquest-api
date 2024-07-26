<?php

require_once '../vendor/autoload.php';
require 'config.php';
require 'helpers/functions.php';
require '../app/Core/Router.php';

Router::get('/', 'HomeController@index');

Router::run();
