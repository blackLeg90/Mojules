<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
  /**
   * Get home for the layout.
   */
  public function homes()
  {
    return $this->belongsToMany('App\Models\Home');
  }
}
