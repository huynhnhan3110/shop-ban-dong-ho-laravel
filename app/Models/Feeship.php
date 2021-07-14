<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'fee_matp',
    'fee_maqh',
    'fee_xaid',
    'fee_feeship',
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_feeship';
}
