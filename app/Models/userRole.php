<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRole extends Model
{
    use HasFactory;
    protected $table = 'userrole';
    protected $primaryKey = 'id';
    protected $fillable = [
        'userId', 'IdRuangan'
   ];  
}