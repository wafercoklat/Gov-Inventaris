<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\barang;
use App\Models\Ruangan;
use DB;
use Carbon\Carbon;
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

        $data = DB::select("SELECT distinct tr.IdTrans, tr.trans transaksi, tr.created_at tanggal, trd.ReqBy User FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause and (tr.Type = 1) order by tr.created_at DESC");

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
        
        $date = Carbon::today()->format('ym');
        $final = $date.str_pad($lastid, 4, '0', STR_PAD_LEFT);

        $trans = new TransaksiUpdate();
        $trans -> Type = 1;
        $trans -> Trans = "LKB-" .$final;
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
        
        return redirect()->route('Kondisi.index')
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

        $trans = DB::select("SELECT trd.Verified, trd.Done, trd.Status stat, trd.Req, tr.IdTrans, trd.DetailID, trd.Checked, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark, bs.`status`Kondisi FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barangstatus bs ON bs.id = trd.Status LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause and (trd.IdTrans = $id)");

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
    public function update($detailID, $IdTrans, $flag, $IdBarang)
    {   
        // dd($flag);
        // $this->updateDate($detailID, $IdTrans, $flag, $IdBarang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        $d = TransaksiUpdateDetail::where('DetailID',$item)->first();
        if ($item != null) {
            $del = TransaksiUpdateDetail::where('DetailID',$item)->update(['Done' => 'R', 'Req' => 'N', 'Verified' => 'N']);
            DB::table('gatebk')->where('IdBarang', $d->IdBarang)->update(['IdKondisi'=> 8]);
            return redirect()->route('Kondisi.show', $d->IdTrans)->with('success','Barang berhasil di hapus');
        }
        return redirect()->routeroute('Kondisi.show', $d->IdTrans)->with('success','Gagal');
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
        $d = 'N';
         if ($flag == 'Req') {
            TransaksiUpdateDetail::where('DetailID', $detailID)->update(['Req' => 'Y', 'Checked' => 'Y', 'CheckTime' => now(), 'CheckBy' => Auth::user()->name]);
        } elseif ($flag == 'Che') {
            DB::table('gatebk')->where('IdBarang', $IdBarang)->update(['IdKondisi'=> 2]);
            TransaksiUpdateDetail::where('DetailID', $detailID)->update(['Verified' => 'Y', 'VerifedTime' => now(), 'VerifyBy' => Auth::user()->name]);
        } elseif ($flag == 'Bad') {
            DB::table('gatebk')->where('IdBarang', $IdBarang)->update(['IdKondisi'=> 4]);
            TransaksiUpdateDetail::where('DetailID', $detailID)->update(['Done' => 'Y', 'Status' => 4, 'DoneTime' => now()]); 
        } else {
            $v = 'Y'; $c = 'Y'; $s = 7; $d = 'Y';
            DB::table('gatebk')->where('IdBarang', $IdBarang)->update(['IdKondisi'=> 7]);
            TransaksiUpdateDetail::where('DetailID', $detailID)->update(['Done' => 'Y', 'DoneTime' => now()]); 
        }
        
        return redirect()->route('Kondisi.show', $IdTrans)
                        ->with('success','Post updated successfully');

    }

    public function scanTrans()
    {
        $clause = $this->Checkrole();

        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan, br.barcode, br.Code, br.NUP, g.IdKondisi, bs.`status` FROM gatebk g LEFT JOIN barangstatus bs ON bs.id = g.IdKondisi LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $clause");
       
        $Kondisi = statusbarang::where('id',3)->orwhere('id',4)->Pluck('status', 'id');

        return view('Pages.Lapor.Scan',compact('data', 'Kondisi'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }


    // public function Lapor(){
    //     $clause2 = $this->Checkrole2();
        
    //     $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan FROM gatebk g LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN barangdetail brd ON brd.IdBarangDetail = g.IdKondisi AND brd.IdBarang = g.IdBarang LEFT JOIN (SELECT trd.IdBarang, trd.Req FROM transaksidetail trd LEFT JOIN transaksi tr ON trd.IdTrans = tr.IdTrans ORDER BY tr.counter DESC) tr ON tr.IdBarang = br.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $clause2 (brd.IdBarangDetail is null or brd.Status = 3) and (tr.Req = 'N' OR tr.Req IS NULL)");

    //     $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
    //     return view('Pages.Lapor.Scan',compact('data', 'Ruangan'));
    // }

    public function print($id){
    
        $clause = $this->Checkrole();

        $trans = DB::select("SELECT trd.Verified, trd.Req, trd.Status stat, tr.IdTrans, trd.DetailID, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark, bs.`status` Kondisi, trd.Status FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barangstatus bs ON bs.id = trd.`Status` LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause and (trd.IdTrans = $id) and (trd.Done != 'R')");

        setlocale(LC_TIME, 'id_ID');
        $date = Carbon::now()->isoFormat('D MMMM Y');
        
        return view('layouts.print.PrintLapor',compact('trans', 'date'))-> with ('i', (request()->input('page', 1) - 1) * 100); 
    }
}
