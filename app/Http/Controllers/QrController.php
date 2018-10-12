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

  public function updateLocation(Request $request, $id, $location)
  {
    $qr = Qr::where('code', '=', $id)->first();
    if ($qr) {
      $loc = Location::where('qr_id', '=', $qr->id)
        ->where('id', '=', $location)->first();
      if ($loc) {
        $loc->text = $request->input('text');
        $loc->save();
        return $loc;
      }
    }

    return response([
        'error' => 'Missing',
    ], 404);
  }

  public function setLocation(Request $request, $id)
  {
    $qr = Qr::where('code', '=', $id)->first();
    if ($qr) {
      $lat = round($request->input('lat'), 6);
      $lng = round($request->input('lng'), 6);

      $ago = strtotime("-1 hours");

      $loc = Location::where('qr_id', '=', $qr->id)
        ->where('lat', '=', $lat)
        ->where('lng', '=', $lng)
        ->first();
      if ($loc) {
        return response([
          'error' => 'Already found',
        ], 404);
      }

      $loc = Location::where('qr_id', '=', $qr->id)
        ->where('created_at', '>=', date("Y-m-d H:i:s", $ago))
        ->first();
      if ($loc) {
        return response([
          'error' => 'Wait some longer',
        ], 404);
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