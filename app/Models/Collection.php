<?php

namespace App\Models;

use App\Core\Model;

class Collection extends Model
{
  public function index()
  {
    $user_id = 1;
    $this->db->all('collections', ['user_id' => $user_id]);
  }
}
