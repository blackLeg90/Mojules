<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  public function layouts()
  {
    return $this->hasMany('App\Models\Layout');
  }
}
