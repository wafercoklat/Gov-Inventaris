<?php

namespace App\Http\Controllers;
use App\Models\TransaksiUpdate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdditionalFunc extends Controller
{
    public static function getLastId($par, $id){
        $x = empty(TransaksiUpdate::latest($id)->first()->IdTrans);
        if($x){
            $lastid = 1;
        } else {
            $lastid = (TransaksiUpdate::latest($id)->first()->IdTrans)+1;
        }
        return $lastid;
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
