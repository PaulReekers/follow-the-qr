<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
  protected $hidden = ['code'];

  protected $appends = ['distance'];
  public $timestamps = false;

  public function getDistanceAttribute()
  {
    $prev = false;
    $distance = 0;
    foreach ($this->locations as $loc) {
      if ($prev) {
        $distance += $this->distanceCalculation($prev->lat, $prev->lng, $loc->lat, $loc->lng);
      }
      $prev = $loc;
    }
    return $distance;
  }

  protected function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
    // Calculate the distance in degrees
    $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

    // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
    switch($unit) {
      case 'km':
        $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
        break;
      case 'mi':
        $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
        break;
      case 'nmi':
        $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
    }
    return round($distance, $decimals);
  }

  public function locations()
  {
      return $this->hasMany('App\Location');
  }
}
?>