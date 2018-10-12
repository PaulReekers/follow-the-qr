<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Qr;
use Log;

class QrController extends Controller
{

  public function getall()
  {
    return Qr::with('locations')->get();
  }

}

?>