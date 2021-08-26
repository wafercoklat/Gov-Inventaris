<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\userRole;
use App\Models\User;
use App\Models\Ruangan;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $d = DB::Select("Select u.id, u.name, b.NA from users u left join userdetails b on u.id = b.iduser"); 
        $d = DB::Select("Select id, name, NA from users"); 


       return view('pages.User.Uview',compact('d'))
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
        $role = userRole::where('userId', $id);
        $ruangan = DB::select("SELECT a.IdRuangan, a.Name, b.userId  FROM ruangan a LEFT JOIN userrole b ON a.IdRuangan = b.IdRuangan AND b.userId = ".$id." ORDER BY IdRuangan ASC");

        return view('pages.User.Uset',compact('role', 'ruangan', 'id')) ->with('i', (request()->input('page', 1) - 1) * 5);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
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
}
