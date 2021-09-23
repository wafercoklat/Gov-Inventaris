<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Lantai;
use App\Models\RuanganUpdate;
use App\Models\barang;
use DB;

class DRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('ruangan as ru')
        ->select('ru.IdRuangan','ru.Name as Ruangan', 'lt.Name as Lantai', 'ru.NUP', 'ru.Code', 'ru.Keterangan')
        ->join('ruangandetail as rud', 'rud.idRuangan' ,'=', 'ru.IdRuangan')
        ->join('lokasi as lt', 'lt.IdLokasi', '=', 'rud.idLokasi')
        ->orderby('ru.IdRuangan', 'asc')
        ->get();

        return view('Pages.Ruangan.Rview',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Lantai = Lantai::Pluck('Name', 'IdLokasi');
        return view('Pages.Ruangan.Redit',compact('Lantai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Code' => 'required'
        ]);

        Ruangan::create($request->all());

        if(empty(RuanganUpdate::latest('idDetail')->first()->IdTrans)){
            $lastid = 1;
        } else {
            $lastid = (RuanganUpdate::latest('idDetail')->first()->IdTrans)+1;
        }

        $item = new RuanganUpdate();
        $item -> IdRuangan = Ruangan::latest('IdRuangan')->first()->IdRuangan;
        $item -> IdLokasi = $request->IdLokasi;
        $item -> save();

        return redirect()->route('Ruangan')
                        ->with('success','Post created successfully.');         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $id)
    {
        return view('pages.Ruangan.Redit',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ruangan::where('IdRuangan',$id)->first();
        $Lantai = Lantai::Pluck('Name', 'IdLokasi');
        return view('Pages.Ruangan.Redit',compact('data', 'Lantai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        $request->validate([
            'Name' => 'required',
        ]);
         
        $update = Ruangan::where('IdRuangan',$data)->first();
        $update->update($request->all());
        
        DB::table('ruangandetail')->where('IdRuangan', $data)->update(
            [
                'IdLokasi' => $request->IdLokasi
            ]
        );

        return redirect()->route('Ruangan')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        /// melakukan hapus data berdasarkan parameter yang dikirimkan
        $del = Ruangan::where('IdRuangan',$data)->first();
        if ($data != null) {
            $flag = $this->checkRuangan($data);
            if(!$flag){
                return redirect()->route('Ruangan.index')->with('success','Tidak bisa di hapus karena ada beberapa barang di Ruangan ini');
            } else {
                $del->delete();
                return redirect()->route('Ruangan.index')->with('success','Ruangan berhasil di hapus');
            }
        }
        return redirect()->route('Ruangan')->with('success','Gagal');
    }

    protected function checkRuangan($d){
        $check = barang::where('IdRuangan', $d)->first();
        return ($check == NULL or $check == "") ? true : false;
    }
}
