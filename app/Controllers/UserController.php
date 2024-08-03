<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller
{
  protected $model;

  public function __construct()
  {
    $this->model = $this->model('user');
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
    $user = $this->model->find('users', $user_id);
    dd($user);
  }

  public function edit($user_id)
  {
    // Logic to update user info
  }
}
