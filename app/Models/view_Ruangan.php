<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_Ruangan extends Model
{
    use HasFactory;
    protected $table = 'view_ruangan';
    protected $primaryKey = 'IdRuangan';
}
