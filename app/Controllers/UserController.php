<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller
{
  protected $model;

  public function __construct()
  {
    $this->model = $this->model('users');
  }

  public function register()
  {
    // Logic to register a new user
  }

  public function login()
  {
    // Logic to log in a user
  }

  public function logout()
  {
    // Logic to log out a user
  }

  public function info($user_id)
  {
    $user = $this->model->find('users', ['name', 'nickname', 'email', 'created_at'], ['id' => $user_id]);
    if ($user) {
      $this->response($user[0]);
    } else {
      $this->response(['message' => 'User not found'], 404);
    }
  }

  public function edit($user_id)
  {
    // Logic to update user info
  }
}
