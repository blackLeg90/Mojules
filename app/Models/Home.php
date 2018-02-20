<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
  public static $TYPES = ['Studio', 'Type 2', 'Type 3', '3 Rooms', '4 Rooms', '5 Rooms', '3rd Gen'];
  public static $LAYOUTS = ['Open Kitchen', 'Closed Kitchen'];

  /**
   * Get all of the rooms for the home.
   */
  public function rooms()
  {
    return $this->hasMany('App\Models\Room');
  }

  public function layouts()
  {
    return $this->belongsToMany('App\Models\Layout');
  }
}
