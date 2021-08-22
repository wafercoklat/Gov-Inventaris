<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;
    protected $table = 'barangDetail';
    protected $primaryKey = 'IdBarangDetail';
    protected $fillable = [
        'Kondisi', 'Status', 'Remark', 'Pelapor'
    ];
}
