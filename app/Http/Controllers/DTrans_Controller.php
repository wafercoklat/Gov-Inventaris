<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\barang;
use App\Models\Ruangan;
use App\Models\TransaksiUpdate;

class DTrans_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trans= Transaksi::latest()->paginate(5);
        return view('pages.main',compact('trans'))-> with ('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty(TransaksiUpdate::latest('IdTrans')->first()->IdTrans)){
            $lastid = 1;
        } else {
            $lastid = (TransaksiUpdate::latest('IdTrans')->first()->IdTrans)+1;
        }

        $item = new TransaksiUpdate();
        $item -> IdBarang = barang::latest('IdBarang')->first()->IdBarang;
        $item -> IdRuangan = $request->IdRuangan;
        $item -> Trans = "TR-" .$lastid;
        $item -> Remark = "New";
        $item -> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($IdBarang, $IdRuangan)
    {
        $item = barang::where('IdBarang',$IdBarang)->first();
        $Ruangan = Ruangan::where('IdRuangan',$IdRuangan)->first();
        return view('pages.bedit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        /// mengubah data berdasarkan request dan parameter yang dikirimkan
        $barang = barang::where('IdBarang',$id)->first();
        $barang->IdRuangan = $request->IdRuangan;
        $barang->save();
        
        $this->store($request);

        /// setelah berhasil mengubah data
        return redirect()->route('Barang.index')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
