<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class HomeController extends Controller
{
    public function error()
    {
        return view('pages.error');
    }

    public function scan()
    {
        // return redirect()->away('https://192.168.43.86/scan/index.html');
        return view('pages.scanQr');
    }

    public function tmbhbarang()
    {
        return view('pages/badd');
    }
}