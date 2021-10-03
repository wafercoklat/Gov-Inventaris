<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\userRole;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = DB::Select("Select id, name, NA, username, role from users"); 
       
       return view('Pages.User.Uview',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $role = $request->input('role');
        // delete
        userRole::where('userId', $request->userid)->delete();

        // add
        foreach($role as $data){
            $d[]=[
                'userId' => $request->userid,
                'IdRuangan' => $data,
                'created_at' =>now()
            ];
        }
        userRole::insert($d);

        return redirect()->route('User.show', $request->userid)->with('success','Post updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();;
        $role = userRole::where('userId', $id);
        $ruangan = DB::select("SELECT a.IdRuangan, a.Name, b.userId  FROM ruangan a LEFT JOIN userrole b ON a.IdRuangan = b.IdRuangan AND b.userId = ".$id." ORDER BY IdRuangan ASC");

        return view('Pages.User.USet',compact('role', 'ruangan', 'id', 'user')) ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $del = User::where('id',$id)->first(); 
        if ($id != null) {
            $del->delete();
            return redirect()->route('User.index')->with('success','Lantai berhasil di hapus');
        }
        return redirect()->route('User.index')->with('success','Gagal');   
    }
    
    public function NActive($id)
    {
        DB::update("update users set NA = 'Y' where id = ?",[$id]);
        return redirect()->route('User.index')->with('success','Post updated successfully');
    }

    public function Active($id)
    {
        DB::update("update users set NA = 'N' where id = ?",[$id]);
        return redirect()->route('User.index')->with('success','Post updated successfully');
    }

    public function Adduser(Request $request)
    {   
        $rules = [
            'name'              => 'required|string',
            'pass'              => 'required|string',
            'username'          => 'required|string'
        ];
  
        $messages = [
            'username.required'     => 'User wajib diisi',
            'username.username'     => 'User tidak valid',
            'pass.required'     => 'Pass wajib diisi',
            'pass.username'     => 'Pass tidak valid',
        ];

        User::create($request->all());

        return redirect()->route('User')->with('success','Post updated successfully');
    }

    public function profile(){
        $id = Auth::User()->id;
        $data = DB::Select("Select name, NA, username, role, email from users where id = $id"); 

        return view('Pages.User.UProfil', compact('data'));
    }
}
