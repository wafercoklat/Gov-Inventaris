<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganUpdate extends Model
{
    use HasFactory;
    protected $table = 'ruangandetail';
    protected $primaryKey = 'idDetail';
    protected $fillable = [
        'IdRuangan', 'IdLokasi'
   ];  
}
