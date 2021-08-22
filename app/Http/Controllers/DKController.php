<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\Kondisi;
use App\Models\TransaksiUpdate;

class DKController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
     return route('Barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //// menampilkan halaman create
        $data = barang::Pluck('Name', 'IdBarang');
        return view('pages.Kondisi.Kadd',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'Remark' => 'required',
            'Kondisi' => 'required'
        ]);
        
        $item = new Kondisi();
        $item -> IdBarang = $request->IdBarang;
        $item -> Status = "On Going";
        $item -> Kondisi = $request->Kondisi;
        $item -> Remark = $request->Remark;
        $item -> save();
        
        /// redirect jika sukses menyimpan data
        return redirect()->route('Barang.index')
                        ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(barang $item)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('item.show',$post->id) }}
        return view('pages.Kondisi.bedit',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('item.edit',$item->id) }}
        $item = Kondisi::where('IdBarangDetail',$id)->first();
        return view('pages.Kondisi.bedit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item)
    {
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'Name' => 'required',
        ]);
         
        // var_dump($item);
        /// mengubah data berdasarkan request dan parameter yang dikirimkan
        $update = Kondisi::where('IdBarangDetail',$item)->first();
        $update->update($request->all());
         
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
    public function destroy($item)
    {
        /// melakukan hapus data berdasarkan parameter yang dikirimkan
        $del = Kondisi::where('IdBarangDetail',$item)->first();
  
        if ($item != null) {
            $del->delete();
            return redirect()->route('Barang.index')->with('success','Barang berhasil di hapus');
        }
        return redirect()->route('Barang.index')->with('success','Gagal');
    }

}
