<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUpdateDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksidetail';
    protected $primaryKey = 'DetailID';
    protected $fillable = [
        'IdBarang', 'IdRuangan', 'IdRuangan2', 'Remark', 'Req', 'ReqBy', 'Verified', 'VerifBy'
   ];  
}
