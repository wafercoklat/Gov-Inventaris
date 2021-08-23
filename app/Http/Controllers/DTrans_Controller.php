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
        // $trans= Transaksi::latest()->paginate(5);

        $clause = $this->Checkrole();
        
        $trans = DB::select("SELECT tr.IdTrans, tr.trans transaksi, br.Name barang, ru.Name ruangan, lt.Name Lantai, brd.Kondisi, brd.`Status`, brd.Remark, tr.created_at, tr.updated_at, tr.User FROM transaksi tr LEFT JOIN barang br ON br.IdBarang = tr.IdBarang LEFT JOIN barangdetail brd ON brd.IdBarang = br.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = tr.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi  lt ON lt.IdLokasi = rud.idLokasi where (tr.Req = 'Y') and (".$clause.")");

        // dd($trans);

        return view('pages.main',compact('trans'))-> with ('i', (request()->input('page', 1) - 1) * 5);
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
    public function store($request)
    {
        // dd($request);
        if(empty(TransaksiUpdate::latest('IdTrans')->first()->IdTrans)){
            $lastid = 1;
        } else {
            $lastid = (TransaksiUpdate::latest('IdTrans')->first()->IdTrans)+1;
        }
        
        $counter = (TransaksiUpdate::latest('Counter')->first()->IdBarang)+1;
        $update = barang::where('IdBarang',$request)->first();
        $item = new TransaksiUpdate();
        $item -> IdBarang = $request; 
        $item -> IdRuangan = $update->IdRuangan;
        $item -> Trans = "TR-" .$lastid;
        $item -> Counter = $counter;
        $item -> Remark = "Pindah";
        $item -> Req = 'Y';
        $item -> ReqTime = now();
        $item -> ReqBy = '';
        $item -> save();
        
        // $update->update(array('Req' => 'Y'));

        return redirect()->route('Barang.index')
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
    public function update($request)
    {   
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

    public function updateDate($var){

        $get = DB::select('SELECT IdBarang, IdRuangan, Req, Verified, VerifedTime FROM transaksi where IdTrans = '.$var);

        $barang = barang::where('IdBarang',$get[0]->IdBarang)->first();
        $barang->IdRuangan = $get[0]->IdRuangan;
        $barang->Req = 'N';
        $barang->save();

        $trans = Transaksi::where('IdTrans', $var)->first();
        $trans->Req = 'N';
        $trans->Verified = 'Y';
        $trans->VerifedTime = now();
        $trans->save();
    }
}
