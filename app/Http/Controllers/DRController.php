<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\view_Ruangan;
use App\Models\Ruangan;
use App\Models\Lantai;
use App\Models\RuanganUpdate;

class DRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = view_Ruangan::latest()->paginate(5);
        return view('pages.Ruangan.Rview',compact('data'))
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
        return view('pages.Ruangan.Radd',compact('Lantai'));
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

        return redirect()->route('Ruangan.index')
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
        return view('pages.Ruangan.Redit',compact('data'));
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
         
        return redirect()->route('Ruangan.index')
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
            $del->delete();
            return redirect()->route('Ruangan.index')->with('success','Ruangan berhasil di hapus');
        }
        return redirect()->route('Ruangan.index')->with('success','Gagal');
    }
}
