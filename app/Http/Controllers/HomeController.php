<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class HomeController extends Controller
{
    public function main()
    {
        return view('pages/main');
    }

    public function barang()
    {
        return view('pages/barang');
    }

    public function tmbhbarang()
    {
        return view('pages/badd');
    }
}