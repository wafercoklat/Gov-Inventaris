<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\barang;
use App\Models\Ruangan;
use DB;
use Carbon\Carbon;
use App\Models\TransaksiUpdate;
use App\Models\TransaksiUpdateDetail;
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
     
        $trans = DB::select("SELECT distinct trd.Req, tr.IdTrans, tr.trans transaksi, tr.created_at tanggal, trd.ReqBy User FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = trd.IdRuangan LEFT JOIN ruangan ru2 ON ru2.IdRuangan = trd.IdRuangan2 LEFT JOIN ruangandetail rud ON rud.idRuangan = ru2.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause order by tr.created_at DESC");

        return view('Pages.Pindah.Show',compact('trans'))-> with ('i', (request()->input('page', 1) - 1) * 100);
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
        $check = TransaksiUpdate::latest('Counter')->where('Type', 0)->first();
        $lastid = (empty($check)) ? 1 : ($check->Counter)+1 ;

        $date = Carbon::today()->format('ym');
        $final = $date.str_pad($lastid, 4, '0', STR_PAD_LEFT);

        $trans = new TransaksiUpdate();
        $trans -> Type = 0;
        $trans -> Trans = "LPB-".$final;
        $trans -> Counter = $lastid;
        $trans -> save();
        $idtrans = TransaksiUpdate::latest('IdTrans')->first()->IdTrans;

        for ($i=0; $i < count($Req['IdBarang']) ; $i++) { 
            $update = barang::where('IdBarang', $Req['IdBarang'][$i])->first();

            $trandet = new TransaksiUpdateDetail();
            $trandet -> Req = 'Y';
            $trandet -> ReqBy = Auth::user()->name;
            $trandet -> ReqTime = now();
            $trandet -> IdTrans = $idtrans;
            $trandet -> Status = 5;
            $trandet -> IdBarang = $Req['IdBarang'][$i];
            $trandet -> IdRuangan = $update->IdRuangan;
            $trandet -> IdRuangan2 = $Req['IdRuangan'][$i];
            $trandet -> Remark = $Req['Keterangan'][$i];
            $trandet -> save();

            DB::table('gatebk')->where('IdBarang', $Req['IdBarang'][$i])->update(['IdKondisi'=> 5]);
        }
        
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
        $clause = $this->Checkrole2();

        $trans = DB::select("SELECT trd.Req, trd.Checked, tr.IdTrans, trd.DetailID, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, ru2.Code codeRuangan2, ru2.IdRuangan, ru2.Name ruangan2, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark, trd.Done FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = trd.IdRuangan LEFT JOIN ruangan ru2 ON ru2.IdRuangan = trd.IdRuangan2 LEFT JOIN ruangandetail rud ON rud.idRuangan = ru2.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause (trd.IdTrans = $id)");

        return view('Pages.Pindah.Detail',compact('trans'))-> with ('i', (request()->input('page', 1) - 1) * 100);      
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
    public function update($detailID, $IdBarang, $IdRuangan)
    {   
        barang::where('IdBarang', $IdBarang)->update(['IdRuangan' => $IdRuangan]);

        $trans = TransaksiUpdateDetail::where('detailID', $detailID)->first();
        $trans->Req = 'N';
        $trans->Verified = 'Y';
        $trans->Status = 6;
        $trans->VerifedTime = now();
        $trans->save(); 

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
        $d = TransaksiUpdateDetail::where('DetailID',$item)->first();
        if ($item != null) {
            $del = TransaksiUpdateDetail::where('DetailID',$item)->update(['Done' => 'R', 'Req' => 'N', 'Verified' => 'N']);
            DB::table('gatebk')->where('IdBarang', $d->IdBarang)->update(['IdKondisi'=> 8]);
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
            return ($clause == "") ? "" : "where $clause ";
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
    
    public function Checked($detailID, $IdBarang, $IdRuangan, $IdTrans){
        TransaksiUpdateDetail::where('DetailID', $detailID)
        ->update(['Req' => 'N', 'Checked' => 'Y', 'CheckTime' => now(), 'CheckBy' => Auth::user()->name]);

        return redirect()->route('Trans.show',$IdTrans)
                        ->with('success','Post updated successfully');
    }

    public function updateDate($detailID, $IdBarang, $IdRuangan, $IdTrans){
        TransaksiUpdateDetail::where('DetailID', $detailID)
        ->update(['Req' => 'N', 'Verified' => 'Y', 'VerifedTime' => now(), 'VerifyBy' => Auth::user()->name, 'Done' => 'Y']);

        DB::table('gatebk')->where('IdBarang', $IdBarang)->update(['IdKondisi'=> 6, 'IdRuangan'=> $IdRuangan]);

        return redirect()->route('Trans.show',$IdTrans)
                        ->with('success','Post updated successfully');
    }
 
    public function scanTrans()
    {
        $clause = $this->Checkrole();

        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan, br.barcode, br.Code, br.NUP, g.IdKondisi, bs.`status` FROM gatebk g LEFT JOIN barangstatus bs ON bs.id = g.IdKondisi LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN ruangan ru2 ON ru2.IdRuangan = br.IdRuangan $clause");
       
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');

        return view('Pages.Pindah.Scan',compact('data', 'Ruangan'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }

    public function print($id){
        $clause = $this->Checkrole2();

        $trans = DB::select("SELECT trd.Req, tr.IdTrans, trd.DetailID, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, ru2.Code codeRuangan2, ru2.IdRuangan, ru2.Name ruangan2, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = trd.IdRuangan LEFT JOIN ruangan ru2 ON ru2.IdRuangan = trd.IdRuangan2 LEFT JOIN ruangandetail rud ON rud.idRuangan = ru2.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause (trd.IdTrans = $id)");

        setlocale(LC_TIME, 'id_ID');
        $date = Carbon::now()->isoFormat('D MMMM Y');

        return view('layouts.print.PrintPindah', compact('trans', 'date'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }
}
