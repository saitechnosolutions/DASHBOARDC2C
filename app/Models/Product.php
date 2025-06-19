<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
    // protected $fillable = [ 'category_id', 'subcategory_id', 'product_name', 'product_quantity', 'product_mrp_price', 'product_regular_price', 'product_desc', 'product_image', 'product_spec', 'product_brand_name', 'product_brand_material', 'product_brand_type', 'product_approval_days', 'product_unit_value', 'product_product_value', 'product_cate_name', 'product_subcate_name', 'product_size_value' ];
    protected $table = 'products';
    protected $guarded = [];
}