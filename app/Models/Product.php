<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamp = false;
    protected $fillable = [
    'category_id',
    'branch_id',
    'product_content',
    'product_keywords',
    'product_desc',
    'product_price',
    'product_image',
    'product_name',
    'product_status'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
