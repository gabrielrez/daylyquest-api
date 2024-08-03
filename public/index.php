<?php

use App\Core\Router;

require_once '../vendor/autoload.php';
require 'config.php';
require 'helpers/functions.php';
require '../app/Core/Router.php';

// Index
Router::get('/', 'HomeController::index'); // Home page

// Authentication
Router::post('/register', 'UserController::register'); // User registration
Router::post('/login', 'UserController::login'); // User login
Router::post('/logout', 'UserController::logout'); // User logout

// Users
Router::get('/users/{user_id}', 'UserController::info'); // Get user info
Router::put('/users/{user_id}', 'UserController::edit'); // Update user info

// Collections
Router::get('/collections', 'CollectionController::index'); // List all collections of the authenticated user
Router::post('/collections', 'CollectionController::create'); // Create a new collection
Router::get('/collections/{collection_id}', 'CollectionController::info'); // Get collection info
Router::put('/collections/{collection_id}', 'CollectionController::edit'); // Update collection
Router::delete('/collections/{collection_id}', 'CollectionController::delete'); // Delete collection

// Goals
Router::get('/collections/{collection_id}/goals', 'GoalController::getByCollectionId'); // List goals in a collection
Router::post('/collections/{collection_id}/goals', 'GoalController::create'); // Create a goal in a collection
Router::get('/collections/{collection_id}/goals/{goal_id}', 'GoalController::info'); // Get goal info
Router::put('/collections/{collection_id}/goals/{goal_id}', 'GoalController::edit'); // Update goal
Router::delete('/collections/{collection_id}/goals/{goal_id}', 'GoalController::delete'); // Delete goal
Router::post('/collections/{collection_id}/goals/{goal_id}/complete', 'GoalController::complete'); // Complete goal

// Rank
Router::get('/rank', 'RankController::index'); // Get user rank

// Run
Router::run(); // Run the router
