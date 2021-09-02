<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusbarang extends Model
{
    use HasFactory;
    protected $table = 'barangstatus';
    protected $primaryKey = 'id';
}
