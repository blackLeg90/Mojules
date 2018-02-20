<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $fillable = ['id', 'roomName', 'roomImage'];

  /**
   * Get all of the materials for the room.
   */
  public function materials()
  {
    return $this->hasMany('App\Models\Material');
  }
}
