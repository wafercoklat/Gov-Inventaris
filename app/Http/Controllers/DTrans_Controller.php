<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\barang;
use App\Models\Ruangan;
use DB;
use App\Models\TransaksiUpdate;
use App\Controllers\AdditionalFunc;
use Illuminate\Support\Facades\Auth;

class DTrans_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clause = $this->Checkrole();
        $clause2 = $this->Checkrole2();

        $trans = DB::select("SELECT tr.Req, tr.IdTrans, tr.trans transaksi, br.Code, br.NUP, br.Name barang, ru.Name ruangan, ru2.Name ruangan2, lt.Name Lantai, tr.created_at, tr.ReqBy User FROM transaksi tr LEFT JOIN barang br ON br.IdBarang = tr.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = tr.IdRuangan LEFT JOIN ruangan ru2 ON ru2.IdRuangan = tr.IdRuangan2 LEFT JOIN ruangandetail rud ON rud.idRuangan = ru2.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi where $clause order by tr.created_at DESC");
       
        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan FROM gatebk g LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN barangdetail brd ON brd.IdBarangDetail = g.IdKondisi AND brd.IdBarang = g.IdBarang LEFT JOIN (SELECT IdBarang, Req from transaksi ORDER BY Counter DESC LIMIT 1) tr ON tr.IdBarang = br.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan where ($clause2) and (brd.IdBarangDetail is null or brd.Status = 3) and (tr.Req = 'N' OR tr.Req IS NULL)");
       
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');

        return view('pages.main',compact('trans', 'data', 'Ruangan'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($var)
    {
        $this -> updateDate($var);

        return redirect()->route('Trans.index')
        ->with('success','Post updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $Req)
    {
        if(empty(TransaksiUpdate::latest('Counter')->where('IdBarang', $Req->IdBarang)->first())){
            $lastid = 1;
        } else {
            $lastid = (TransaksiUpdate::latest('Counter')->where('IdBarang', $Req->IdBarang)->first()->Counter)+1;
        }

        $No = (empty(TransaksiUpdate::latest()->first()->IdTrans)) ? 1 : TransaksiUpdate::latest()->first()->IdTrans + 1;
        $update = barang::where('IdBarang', $Req->IdBarang)->first();

        $item = new TransaksiUpdate();
        $item -> IdBarang = $Req->IdBarang; 
        $item -> Type = "PI";
        $item -> IdRuangan = $update->IdRuangan;
        $item -> IdRuangan2 = $Req ->IdRuangan; 
        $item -> Trans = "TR-" .$No;
        $item -> Counter = $lastid;
        $item -> Remark = "Pindah";
        $item -> Req = 'Y';
        $item -> ReqTime = now();
        $item -> ReqBy = Auth::user()->name;
        $item -> save();
        
        return redirect()->route('Trans.index')
                        ->with('success','Barang sedang di Request untuk Pindah');
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
    public function update(Request $request, $IdBarang)
    {   
        $this->store($request, $IdBarang);

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
        $del = TransaksiUpdate::where('IdTrans',$item)->first();
  
        if ($item != null) {
            $del->delete();
            return redirect()->route('Trans.index')->with('success','Barang berhasil di hapus');
        }
        return redirect()->route('Trans.index')->with('success','Gagal');
    }

    public function Checkrole(){
        $userid = Auth::user()->id;
        $data = DB::select('SELECT IdRuangan FROM userrole WHERE userid =(?)',array($userid));
        $flag = true;
        $clause = "";
        for ($i=0; $i < count($data) ; $i++) {
            if ($flag) {
                $clause = "ru2.IdRuangan = ".$data[$i]->IdRuangan;
                $flag = false;
            } else {
                $clause .= " Or ru2.IdRuangan = ".$data[$i]->IdRuangan;
            }
        }
        return ($clause == "") ? "" : ".$clause.";
    }

    public function Checkrole2(){
        $userid = Auth::user()->id;
        $data = DB::select('SELECT IdRuangan FROM userrole WHERE userid =(?)',array($userid));
        $flag = true;
        $clause = "";
        for ($i=0; $i < count($data) ; $i++) {
            if ($flag) {
                $clause = "ru.IdRuangan = ".$data[$i]->IdRuangan;
                $flag = false;
            } else {
                $clause .= " Or ru.IdRuangan = ".$data[$i]->IdRuangan;
            } 
        }
        return $clause;
    }

    public function updateDate($var){

        $get = DB::select('SELECT IdBarang, IdRuangan, IdRuangan2, Req, Verified, VerifedTime FROM transaksi where IdTrans = '.$var);
        
        $barang = barang::where('IdBarang',$get[0]->IdBarang)->first();
        $barang->IdRuangan = $get[0]->IdRuangan2;
        $barang->save();

        $trans = Transaksi::where('IdTrans', $var)->first();
        $trans->Req = 'N';
        $trans->Verified = 'Y';
        $trans->VerifedTime = now();
        $trans->save();
    }
}
