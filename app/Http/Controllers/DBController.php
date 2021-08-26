<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\Ruangan;
use App\Models\userRole;
use App\Models\view_Barang;
use DB;
use App\Http\Controllers\AdditionalFunc;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiUpdate;

class DBController extends Controller
{
    public function index()
    {
        $clause = $this->Checkrole();
        
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        // $item = view_Barang::latest()->paginate(5);
        
        $item = DB::select('SELECT br.IdBarang, ru.IdRuangan, br.Code, br.Name barang, br.nup, ru.Name ruangan, lt.Name Lantai, brd.Kondisi, brd.`Status`, brd.Remark , br.created_at, br.updated_at, tr.Req FROM barang br LEFT JOIN ( SELECT IdBarang, Kondisi, `Status`, Remark , created_at, updated_at FROM barangdetail ORDER BY counter DESC LIMIT 1) brd ON brd.IdBarang = br.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi LEFT JOIN ( SELECT IdBarang, Req FROM transaksi ORDER BY counter DESC LIMIT 1) tr on tr.IdBarang = br.IdBarang '.$clause);

        return view('pages.barang',compact('item', 'Ruangan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        //// menampilkan halaman create
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        return view('pages.badd',compact('Ruangan'));
    }

    public function store(Request $request)
    {
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'Name' => 'required',
            'Code' => 'required',
            'IdRuangan' => 'required'
        ]);

        barang::create($request->all());

        $lastid = AdditionalFunc::getLastId("", 'IdTrans');
        $item = new TransaksiUpdate();
        $item -> IdBarang = barang::latest('IdBarang')->first()->IdBarang;
        $item -> IdRuangan = $request->IdRuangan;
        $item -> Trans = "TR-" .$lastid;
        $item -> Remark = "New";
        $item -> Counter = 1;
        $item -> save();

        /// redirect jika sukses menyimpan data
        return redirect()->route('Barang.index')
                        ->with('success','Post created successfully.');
    }

    public function show(barang $item)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('item.show',$post->id) }}
        return view('pages.bedit',compact('item'));
    }

    public function edit($id)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('item.edit',$item->id) }}
        $item = barang::where('IdBarang',$id)->first();
        return view('pages.bedit',compact('item'));
    }

    public function update(Request $request, $item)
    {
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'Name' => 'required',
        ]);
         
        // var_dump($item);
        /// mengubah data berdasarkan request dan parameter yang dikirimkan
        $update = barang::where('IdBarang',$item)->first();
        $update->update($request->all());
         
        /// setelah berhasil mengubah data
        return redirect()->route('Barang.index')
                        ->with('success','Post updated successfully');
    }

    public function destroy($item)
    {
        /// melakukan hapus data berdasarkan parameter yang dikirimkan
        $del = barang::where('IdBarang',$item)->first();
  
        if ($item != null) {
            $del->delete();
            return redirect()->route('Barang.index')->with('success','Barang berhasil di hapus');
        }
        return redirect()->route('Barang.index')->with('success','Gagal');
    }
    
    public function kondisi($var)
    {
        $data = DB::select('call view_Kondisi(?)', array($var));
        return view('pages.bdetail',compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function Checkrole(){
        $userid = Auth::user()->id;
        $data = DB::select('SELECT IdRuangan FROM userrole WHERE userid =(?)',array($userid));
        $flag = true;
        $clause = "";
        for ($i=0; $i < count($data) ; $i++) {
            if ($flag) {
                $clause = "Where ru.IdRuangan = ".$data[$i]->IdRuangan;
                $flag = false;
            } 
            $clause .= " Or ru.IdRuangan = ".$data[$i]->IdRuangan;
        }

        return $clause;
    }
}
