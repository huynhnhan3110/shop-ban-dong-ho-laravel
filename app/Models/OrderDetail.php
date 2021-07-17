<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'order_code',
    'product_id',
    'product_price',
    'product_name',
    'product_sales_quanlity',
    'order_feeship',
    'order_coupon',
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';
}
