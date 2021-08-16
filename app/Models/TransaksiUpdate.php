<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUpdate extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'IdTrans';
    protected $fillable = [
        'IdBarang', 'IdRuangan', 'Counter'
   ];  
}
