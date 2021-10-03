<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lantai;
use DB;

class DLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lantai::select('IdLokasi','Code', 'Name')->get();
        return view('Pages.Lantai.Lview',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Lantai.LAdd');
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

        Lantai::create($request->all());

        return redirect()->route('Lantai')
                        ->with('success','Post created successfully.');         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lantai $id)
    {
        return view('Pages.Lantai.Ledit',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Lantai::where('IdLokasi',$id)->first();
        return view('Pages.Lantai.Ledit',compact('item'));
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
         
        $update = Lantai::where('IdLokasi',$data)->first();
        $update->update($request->all());
         
        return redirect()->route('Lantai.index')
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
        $del = Lantai::where('IdLokasi',$data)->first();
  
        if ($data != null) {
            $flag = $this->checkLantai($data);
            if (!$flag) {
                return redirect()->route('Lantai.index')->with('success','Tidak bisa di hapus karena Item sedang digunakan');
            } else {
                $del->delete();
                return redirect()->route('Lantai.index')->with('success','Lantai berhasil di hapus');
            }
        }
        return redirect()->route('Lantai')->with('success','Gagal');
    }

    protected function checkLantai($d){
        $check = DB::select('Select idRuangan from ruangandetail where idLokasi = '.$d.' Limit 1');
        return ($check == NULL or $check == "") ? true : false;
    }

}
