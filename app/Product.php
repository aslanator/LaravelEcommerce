<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'price', 'color', 'size'];

    public function images()
    {
        return $this->hasMany(ProductsImages::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_to_products');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'products_to_categories', 'product_id', 'category_id');
    }
}
