<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
  public function allUsers()
  {
    $this->all('users');
  }
}
