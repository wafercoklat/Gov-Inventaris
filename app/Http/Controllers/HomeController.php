<?php
  
namespace App\Http\Controllers;
use App\Models\Ruangan;
  
use Illuminate\Http\Request;
  
class HomeController extends Controller
{
    public function error()
    {
        return view('pages.error');
    }

    public function scan()
    {
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        return view('pages.badd-s', compact('Ruangan'));
    }

    public function tmbhbarang()
    {
        return view('pages/badd');
    }
}