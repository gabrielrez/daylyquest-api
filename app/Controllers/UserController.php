<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller
{
  protected $model;
  protected $table = 'users';

  public function __construct()
  {
    $this->model = $this->model('users');
  }

  public function register()
  {
    // Data comming from form + encript password
    $name = 'Sheldon';
    $nickname = 'sheldon_big_bang_123';
    $email = 'sheldon@gmail.com';
    $password = 123;

    if (empty($name) || empty($nickname) || empty($email) || empty($password)) {
      $this->response(['message' => 'All fields are required'], 400);
      return;
    }

    $user = [
      'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
      'nickname' => htmlspecialchars($nickname, ENT_QUOTES, 'UTF-8'),
      'email' => filter_var($email, FILTER_VALIDATE_EMAIL),
      'password' => $password,
    ];

    try {
      $this->model->insert($this->table, $user);
      $this->response(['message' => 'User registered successfully'], 201);
    } catch (\Exception $e) {
      $this->response(['message' => 'Failed to register user'], 500);
    }
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
    $user = $this->model->find($this->table, ['name', 'nickname', 'email', 'created_at'], ['id' => $user_id]);
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
