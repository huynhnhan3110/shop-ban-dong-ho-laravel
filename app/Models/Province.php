<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable = ['name_quanhuyen',
    'type','matp'];
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';
}
