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

        $trans = new TransaksiUpdate();
        $trans -> Type = 0;
        $trans -> Trans = "TR-" .$lastid;
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
            $trandet -> Remark = "Pindah";
            $trandet -> save();

            DB::table('gatebk')->where('IdBarang', $Req['IdBarang'][$i])->update(['IdKondisi'=> 5]);
        }
        
        return redirect()->route('Trans')
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

        $trans = DB::select("SELECT trd.Req, tr.IdTrans, trd.DetailID, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, ru2.Code codeRuangan2, ru2.IdRuangan, ru2.Name ruangan2, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = trd.IdRuangan LEFT JOIN ruangan ru2 ON ru2.IdRuangan = trd.IdRuangan2 LEFT JOIN ruangandetail rud ON rud.idRuangan = ru2.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause (trd.IdTrans = $id)");

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
        // $this->store($request, $IdBarang);
        $barang->IdRuangan = $IdRuangan;
        $barang->save();

        $trans = TransaksiUpdate::where('IdTrans', $detailID);
        $trans->Req = 'N';
        $trans->Verified = 'Y';
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

    public function updateDate($detailID, $IdBarang, $IdRuangan, $IdTrans){
        barang::where('IdBarang', $IdBarang)->update(['IdRuangan' => $IdRuangan]);
        TransaksiUpdateDetail::where('DetailID', $detailID)
        ->update(['Req' => 'N', 'Verified' => 'Y','Status' => 0, 'VerifedTime' => now(), 'VerifyBy' => Auth::user()->name]);

        DB::table('gatebk')->where('IdBarang', $IdBarang)->update(['IdKondisi'=> 1]);

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

    public function pindah(){
        $clause2 = $this->Checkrole2();
        
        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan FROM gatebk g LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN barangdetail brd ON brd.IdBarangDetail = g.IdKondisi AND brd.IdBarang = g.IdBarang LEFT JOIN (SELECT trd.IdBarang, trd.Req FROM transaksidetail trd LEFT JOIN transaksi tr ON trd.IdTrans = tr.IdTrans ORDER BY tr.counter DESC) tr ON tr.IdBarang = br.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $clause2 (brd.IdBarangDetail is null or brd.Status = 3) and (tr.Req = 'N' OR tr.Req IS NULL)");

        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        return view('Pages.Pindah.Scan',compact('data', 'Ruangan'));
    }

    public function print($id){
        $clause = $this->Checkrole2();

        $trans = DB::select("SELECT trd.Req, tr.IdTrans, trd.DetailID, tr.trans transaksi, br.IdBarang, br.Code, br.NUP, br.Name barang, ru.Code codeRuangan, ru.Name ruangan, ru2.Code codeRuangan2, ru2.IdRuangan, ru2.Name ruangan2, lt.Name Lantai, tr.created_at tanggal, trd.ReqBy User, trd.Remark FROM transaksi tr LEFT JOIN transaksidetail trd ON trd.IdTrans = tr.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = trd.IdRuangan LEFT JOIN ruangan ru2 ON ru2.IdRuangan = trd.IdRuangan2 LEFT JOIN ruangandetail rud ON rud.idRuangan = ru2.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause (trd.IdTrans = $id)");

        setlocale(LC_TIME, 'id_ID');
        $date = Carbon::now()->isoFormat('D MMMM Y');

        return view('layouts.print.PrintPindah', compact('trans', 'date'))-> with ('i', (request()->input('page', 1) - 1) * 100);
    }
}
