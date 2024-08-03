<?php

namespace App\Controllers;

use App\Core\Controller;

class RankController extends Controller
{
  protected $model;

  public function __construct()
  {
    $this->model = $this->model('rank');
  }

  public function get()
  {
    // Logic to get rank
  }
}
