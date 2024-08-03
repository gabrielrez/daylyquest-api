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

  public function index()
  {
    $users = $this->model->all('users');
    dd($users);
  }
}
