<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'IdBarang';
    protected $fillable = [
         'IdRuangan', 'Code', 'Name', 'NUP', 'Keterangan', 'Counter', 'Req', 'CreatedBy', 'Kategori'
    ];  
}
