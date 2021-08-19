<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $primaryKey = 'IdLokasi';
    protected $fillable = [
         'Code', 'Name'
    ];  
}
