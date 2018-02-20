<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
  /**
   * Get all of the materials for the room.
   */
  public function images()
  {
    return $this->hasMany('App\Models\Image');
  }
}
