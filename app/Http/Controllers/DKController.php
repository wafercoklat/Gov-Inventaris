<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\barang;
use App\Models\Ruangan;
use DB;
use App\Models\statusbarang;
use App\Models\TransaksiUpdate;
use App\Models\TransaksiUpdateDetail;
use App\Controllers\AdditionalFunc;
use Illuminate\Support\Facades\Auth;

class DKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clause = $this->Checkrole();

        $data = DB::select("SELECT distinct trd.Req, tr.IdTrans, tr.trans transaksi, tr.created_at tanggal, trd.ReqBy User FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause and (tr.Type = 1) order by tr.created_at DESC");

        return view('Pages.Lapor.Show',compact('data'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($detailID, $IdBarang, $IdRuangan)
    {
        $this -> updateDate($detailID, $IdBarang, $IdRuangan);

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
        $check = TransaksiUpdate::latest('Counter')->where('Type', 1)->first();
        $lastid = (empty($check)) ? 1 : ($check->Counter)+1 ;

        $trans = new TransaksiUpdate();
        $trans -> Type = 1;
        $trans -> Trans = "LA-" .$lastid;
        $trans -> Counter = $lastid;
        $trans -> save();
        $idTrans = TransaksiUpdate::latest('IdTrans')->first()->IdTrans;

        for ($i=0; $i < count($Req['IdBarang']) ; $i++) { 
            $trandet = new TransaksiUpdateDetail();
            $trandet -> Req = 'Y';
            $trandet -> ReqBy = Auth::user()->name;
            $trandet -> ReqTime = now();
            $trandet -> IdTrans = $idTrans;
            $trandet -> IdBarang = $Req['IdBarang'][$i];
            $trandet -> Status = $Req['Kondisi'][$i];
            $trandet -> Remark = $Req['Keterangan'][$i];
            $trandet -> save();
            
            DB::table('gatebk')->where('IdBarang', $Req['IdBarang'][$i])->update(['IdKondisi'=> $Req['Kondisi'][$i]]);
        }
        
        return redirect()->route('Lapor.index')
                        ->with('success','Barang sedang di Request untuk Lapor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clause = $this->Checkrole();

        $trans = DB::select("SELECT trd.Verified, trd.Req, tr.IdTrans, trd.DetailID, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark, bs.`status`Kondisi FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barangstatus bs ON bs.id = trd.`Status` LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause and (trd.IdTrans = $id)");

        return view('Pages.Lapor.Detail',compact('trans'))-> with ('i', (request()->input('page', 1) - 1) * 100);      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($detailID, $IdTrans, $flag)
    {   
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
                    $clause = "ru.IdRuangan = ".$data[$i]->IdRuangan;
                    $flag = false;
                } else {
                    $clause .= " Or ru.IdRuangan = ".$data[$i]->IdRuangan;
                }
            }
            return ($clause == "") ? "" : "where ($clause) ";
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
        return (empty($clause)) ? "" : "where ($clause) and";
    }

    public function updateDate($detailID, $IdTrans, $flag, $IdBarang){
        if ($flag == 'Req') {$v = 'Y'; $s = 2; } else {$v = 'N';$s = 1;}
        TransaksiUpdateDetail::where('DetailID', $detailID)
        ->update(['Req' => 'N', 'Verified' => $v,'Status' => $s, 'VerifedTime' => now(), 'VerifyBy' => Auth::user()->name]);

        DB::table('gatebk')->where('IdBarang', $IdBarang)->update(['IdKondisi'=> $s]);

        return redirect()->route('Lapor.show', $IdTrans)
                        ->with('success','Post updated successfully');

    }

    public function scanTrans()
    {
        $clause = $this->Checkrole();

        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan, br.barcode, br.Code, br.NUP, g.IdKondisi, bs.`status` FROM gatebk g LEFT JOIN barangstatus bs ON bs.id = g.IdKondisi LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $clause");
       
        $Kondisi = statusbarang::where('id',3)->orwhere('id',4)->Pluck('status', 'id');

        return view('Pages.Lapor.Scan',compact('data', 'Kondisi'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }

    public function storeScan(Request $Req)
    {
        for ($i=0; $i < count($Req->IdBarang) ; $i++) {   
            if(empty(TransaksiUpdate::latest('Counter')->where('IdBarang', $Req->IdBarang[$i])->first())){
                $lastid = 1;
            } else {
                $lastid = (TransaksiUpdate::latest('Counter')->where('IdBarang', $Req->IdBarang[$i])->first()->Counter)+1;
            }

            $No = (empty(TransaksiUpdate::latest()->first()->IdTrans)) ? 1 : TransaksiUpdate::latest()->first()->IdTrans + 1;
            $update = barang::where('IdBarang', $Req->IdBarang[$i])->first();

            $item = new TransaksiUpdate();
            $item -> IdBarang = $Req->IdBarang[$i]; 
            $item -> Type = 1;
            $item -> IdRuangan = $update->IdRuangan;
            $item -> IdRuangan2 = $Req ->IdRuangan[$i]; 
            $item -> Trans = "TR-" .$No;
            $item -> Counter = $lastid;
            $item -> Remark = "Lapor";
            $item -> Req = 'Y';
            $item -> ReqTime = now();
            $item -> ReqBy = Auth::user()->name;
            $item -> save();
        }
        
        return redirect()->route('Trans.index')
                        ->with('success','Barang sedang di Request untuk Lapor');
    }

    public function Lapor(){
        $clause2 = $this->Checkrole2();
        
        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan FROM gatebk g LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN barangdetail brd ON brd.IdBarangDetail = g.IdKondisi AND brd.IdBarang = g.IdBarang LEFT JOIN (SELECT trd.IdBarang, trd.Req FROM transaksidetail trd LEFT JOIN transaksi tr ON trd.IdTrans = tr.IdTrans ORDER BY tr.counter DESC) tr ON tr.IdBarang = br.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $clause2 (brd.IdBarangDetail is null or brd.Status = 3) and (tr.Req = 'N' OR tr.Req IS NULL)");

        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        return view('Pages.Lapor.Scan',compact('data', 'Ruangan'));
    }
}
