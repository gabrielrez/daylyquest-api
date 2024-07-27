<?php

require_once '../vendor/autoload.php';
require 'config.php';
require 'helpers/functions.php';
require '../app/Core/Router.php';

Router::get('/', 'HomeController@index');

// Users
Router::get('/users/info/{id}', 'Users@getInfo');
Router::post('/users/register', 'Users@register');
Router::post('/users/authorize', 'Users@authorize');
Router::put('/users/update-name/{user_id}', 'Users@updateName');
Router::put('/users/update-nickname/{user_id}', 'Users@updateNickname');
Router::delete('/users/delete/{user_id}', 'Users@delete');

// Collections
Router::get('/collections/{user_id}', 'Collections@getAll');
Router::post('/collections/create', 'Collections@create');
Router::put('/collections/update/{collection_id}', 'Collections@update');
Router::delete('/collections/delete/{collection_id}', 'Collections@delete');

// Tasks
Router::get('/tasks/{user_id}', 'Tasks@getAll');
Router::post('/tasks/create', 'Tasks@create');
Router::put('/tasks/update/{task_id}', 'Tasks@update');
Router::delete('/tasks/delete/{task_id}', 'Tasks@delete');

Router::run();
