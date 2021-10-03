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

        $item = DB::select("SELECT br.IdBarang, ru.IdRuangan, br.Code, br.Name barang, br.nup, ru.Name ruangan, lt.Name Lantai, bs.`status`, br.created_at, br.updated_at, if (g.IdKondisi = 6, 'Berhasil Pindah', IF (g.IdKondisi = 7,'Berhasil Diperbaiki','')) Remark, g.IdKondisi FROM gatebk g LEFT JOIN barangstatus bs ON bs.id = g.IdKondisi LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = g.IdRuangan LEFT JOIN ruangandetail rud ON rud.idRuangan = ru.IdRuangan LEFT JOIN lokasi lt ON lt.IdLokasi = rud.idLokasi $clause Order By br.IdBarang desc");

        return view('Pages.Barang.Show',compact('item', 'Ruangan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        //// menampilkan halaman create
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        $item = barang::Pluck('Name', 'barcode');
        return view('Pages.Barang.Add',compact('Ruangan', 'item'));
    }

    public function store(Request $request)
    {
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'Name' => 'required',
            'Code' => 'required',
            'IdRuangan' => 'required'
        ]);
        

        $user = Auth::user()->username;
        $request->merge(["CreatedBy" => $user, "Kategori" => 2]);
        barang::create($request->all());

        $IdBarang = barang::latest('IdBarang')->first()->IdBarang;

        DB::table('gateBK')->insert(['IdBarang'=>$IdBarang, 'IdKondisi'=> 0, 'IdRuangan'=> $request->IdRuangan]);

        /// redirect jika sukses menyimpan data
        return redirect()->route('Barang.index')
                        ->with('success','Post created successfully.');
    }

    public function show(barang $item)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('item.show',$post->id) }}
        return view('Pages.bedit',compact('item'));
    }

    public function edit($id)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('item.edit',$item->id) }}
        $item = barang::where('IdBarang',$id)->first();
        return view('Pages.Barang.Edit',compact('item'));
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

    public function storeBR(Request $req)
    {
        for ($i=0; $i < count($req->Name) ; $i++) {    
            $barang = new barang();
            $barang -> IdRuangan = $req->IdRuangan[0];
            $barang -> Code = $req->Code[$i];
            $barang -> Name = $req->Name[$i];
            $barang -> Kategori = 1;
            $barang -> NUP =  $req->nup[$i];
            $barang -> barcode =  $req->barcode[$i];
            $barang -> Keterangan = 'Baru diTambahkan';
            $barang -> CreatedBy = Auth::user()->username;
            $barang -> save();
    
            DB::table('gatebk')->insert(['IdBarang'=>$barang->IdBarang, 'IdKondisi'=> 1, 'IdRuangan' => $req->IdRuangan[0]]);
            
        }
        return redirect()->route('Barang.index')
                        ->with('success','Post created successfully.');
    }

    public function scan()
    {
        $clause = $this->Checkrole();
        $Ruangan = Ruangan::Pluck('Name', 'IdRuangan');
        $item = DB::select('Select Name, barcode from barang');
        $data = DB::select("SELECT br.IdBarang, br.Name, br.IdRuangan, br.barcode, br.Code, br.NUP, g.IdKondisi, bs.`status` FROM gatebk g LEFT JOIN barangstatus bs ON bs.id = g.IdKondisi LEFT JOIN barang br ON br.IdBarang = g.IdBarang LEFT JOIN ruangan ru ON ru.IdRuangan = br.IdRuangan $clause");
        return view('Pages.Barang.Scan', compact('Ruangan', 'item', 'data'));
    }
}

