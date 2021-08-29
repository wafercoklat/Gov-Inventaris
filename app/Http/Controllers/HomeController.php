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
        return view('pages.scanQr');
    }

    public function tmbhbarang()
    {
        return view('pages/badd');
    }
}