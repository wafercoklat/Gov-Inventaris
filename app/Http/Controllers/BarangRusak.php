<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Kondisi;
use App\Models\barang;

class BarangRusak extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clause = $this->Checkrole();

        $rusakberat = DB::select('SELECT trd.Verified, trd.Req, tr.trans transaksi, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark, bs.`status`Kondisi FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barangstatus bs ON bs.id = trd.`Status` LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi where ('.$clause.') and trd.Status = 4');

        $rusakringan = DB::select('SELECT trd.Verified, trd.Req, tr.trans transaksi, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark, bs.`status`Kondisi FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barangstatus bs ON bs.id = trd.`Status` LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi where ('.$clause.') and trd.Status = 3');

        return view('Pages.BarangRusak.Show',compact('rusakberat', 'rusakringan'))-> with ('i', (request()->input('page', 1) - 1) * 100);
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
    public function store($request)
    {
        
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
    public function edit($request)
    {        
        $item = new Kondisi();
        $item -> IdBarang =$request;
        $item -> Status = 3;
        $item -> Remark = 'Barang dikembalikan';
        $item -> Pelapor = Auth::user()->name;
        $item -> save();

        DB::table('gateBK')->where('IdBarang',$request)->update(['IdKondisi'=> $item->IdBarangDetail]);
        return redirect()->route('Daftar-Barang-Rusak.index')
                            ->with('success','Post updated successfully');
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {

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

    
    public function Checkrole(){
        $userid = Auth::user()->id;
        $data = DB::select('SELECT IdRuangan FROM userrole WHERE userid =(?)',array($userid));
        $flag = true;
        $clause = "";
        for ($i=0; $i < count($data) ; $i++) {
            if ($flag) {
                $clause = "ru.IdRuangan = ".$data[$i]->IdRuangan;
                $flag = false;
            } 
            $clause .= " Or ru.IdRuangan = ".$data[$i]->IdRuangan;
        }
        return $clause;
    }
}
