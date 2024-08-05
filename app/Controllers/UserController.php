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
    $encrypted_password = password_hash($password, PASSWORD_ARGON2I);

    if (empty($name) || empty($nickname) || empty($email) || empty($password)) {
      $this->response(['message' => 'All fields are required'], 400);
      return;
    }

    $user = [
      'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
      'nickname' => htmlspecialchars($nickname, ENT_QUOTES, 'UTF-8'),
      'email' => filter_var($email, FILTER_VALIDATE_EMAIL),
      'password' => $encrypted_password,
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
    // Data comming from form + encripted password
    $email = 'sheldon@gmail.com';
    $password = 123;

    if (empty($email) || empty($password)) {
      $this->response(['message' => 'All fields are required'], 400);
      return;
    }

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
      $this->response(['message' => 'Invalid email'], 400);
      return;
    }

    try {
      $userExists = $this->model->search($this->table, [
        'email' => $email,
        'password' => $password,
      ]);

      if ($userExists) {
        $this->response(['message' => 'User logged successfully'], 200);
      } else {
        $this->response(['message' => 'Invalid email or password'], 401);
      }
    } catch (\Exception $e) {
      $this->response(['message' => 'Failed to log user', 'error' => $e->getMessage()], 500);
    }
  }

  public function logout()
  {
    // Logic to log out a user
  }

  public function info($user_id)
  {
    $user = $this->model->find($this->table, ['name', 'nickname', 'email', 'created_at'], ['id' => $user_id]);
    if (!$user) {
      $this->response(['message' => 'User not found'], 404);
      return;
    }
    $this->response($user[0]);
  }

  public function edit($user_id)
  {
    // Logic to update user info
  }

  public function delete($user_id)
  {
    if (empty($user_id) || !is_numeric($user_id)) {
      $this->response(['message' => 'Invalid user ID'], 400);
      return;
    }

    try {
      $this->model->delete($this->table, $user_id);
      $this->response(['message' => 'User deleted successfully'], 200);
    } catch (\Exception $e) {
      $this->response(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
    }
  }
}
