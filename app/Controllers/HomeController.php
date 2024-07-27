<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    echo 'Hi, this is the DaylyQuest API! <br><a href="https://github.com/gabrielrez/daylyquest-api" target="_blank">Github repository link</a>';
  }
}
