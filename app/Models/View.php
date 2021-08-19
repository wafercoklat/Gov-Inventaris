<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $table;
    protected $primaryKey;

    public static function Barang(){
        $table = 'view_barang';
        $primaryKey = 'IdBarang';

        return $table $primaryKey;
    }
    
    public static function Ruangan(){
        $this->$table = 'view_ruangan';
        $this->$primaryKey = 'IdRuangan';
    }
    
    public static function Lantai(){
        $this->$table = '';
        $this->$primaryKey = '';
    }
    
    public static function Trans(){
        $this->$table = '';
        $this->$primaryKey = '';
    }
}
