<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  public function qr()
  {
      return $this->hasOne('App\Qr');
  }
}