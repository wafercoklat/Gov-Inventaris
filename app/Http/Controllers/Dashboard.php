<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = $this->Checkrole();
        $barang = DB::select("SELECT COUNT(IdBarang) a FROM barang");
        $trans = DB::select("SELECT COUNT(b.Req) a from gatebk a JOIN transaksidetail b ON a.IdBarang = b.IdBarang WHERE b.Req = 'Y' AND a.IdKondisi = 5");
        $berat = DB::select("SELECT COUNT(IdBarang) a FROM gatebk where IdKondisi = 4");
        $ringan = DB::select("SELECT COUNT(IdBarang) a FROM gatebk where IdKondisi = 3");
        $data = DB::select("SELECT br.Name, br.NUP, br.Code, tr.IdTrans, trd.ReqBy user, tr.Type, trd.`Status`, gt.IdKondisi kondisi, ru.Name ruangan, trd.created_at Tanggal, tr.Trans, trd.Done FROM transaksi tr JOIN transaksidetail trd ON tr.IdTrans = trd.IdTrans LEFT JOIN barang br ON br.IdBarang = trd.IdBarang LEFT JOIN gatebk gt ON gt.IdBarang = br.IdBarang LEFT JOIN barangstatus bs ON bs.id = gt.IdKondisi LEFT JOIN ruangan ru ON ru.IdRuangan = trd.IdRuangan2 UNION SELECT br.Name, br.NUP, br.Code, NULL, br.CreatedBy, 3, 0, 0, ru.Name ruangan, br.created_at Tanggal, br.Code, NULL FROM barang br JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $check ORDER BY Tanggal desc");

        return view('Pages.Dashboard', compact('barang','trans','berat', 'ringan', 'data'))-> with ('i', (request()->input('page', 1) - 1) * 100);
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
        //
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
    public function edit($id)
    {
        //
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
        //
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
                } else {
                    $clause .= " Or ru.IdRuangan = ".$data[$i]->IdRuangan;
                }
            }
            return ($clause == "") ? "" : "where $clause ";
    }
}
