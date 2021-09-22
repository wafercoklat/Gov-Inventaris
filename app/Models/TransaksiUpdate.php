<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUpdate extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'DetailID';
    protected $fillable = [
       'Counter', 'Type' ,'Trans', 'Req', 'ReqTime', 'ReqBy', 'Status', 'Keterangan'
   ];  
}
