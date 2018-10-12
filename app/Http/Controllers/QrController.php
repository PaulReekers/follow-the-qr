<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Qr;
use App\Location;
use Log;

class QrController extends Controller
{

  public function getall()
  {
    return Qr::with('locations')->get();
  }

  public function get($id)
  {
    $qr = Qr::where('code', '=', $id)->first();
    if ($qr) {
      return $qr;
    } else {
      return response([
          'error' => 'Missing',
      ], 404);
    }
  }

  public function setLocation(Request $request, $id)
  {
    $qr = Qr::where('code', '=', $id)->first();
    if ($qr) {
      $lat = $request->input('lat');
      $lng = $request->input('lng');

      $ago = strtotime("-1 hours");
      $locations = $qr->locations;
      foreach ($locations as $location) {
        if ($location->lat == $lat && $location->lng == $lng) {
          return response([
              'error' => 'Location already exists',
          ], 404);
        }

        $dateFromDatabase = ($location->created_at->timestamp);
        if ($dateFromDatabase >= $ago) {
          return response([
              'error' => 'Wait some longer ' . $dateFromDatabase." ".$ago,
          ], 404);
        }
      }

      $loc = new Location();
      $loc->qr_id = $qr->id;
      $loc->lat = $lat;
      $loc->lng = $lng;
      $loc->text = '';
      $loc->save();

      return $loc;
    } else {
      return response([
          'error' => 'Missing',
      ], 404);
    }
  }
}

?>