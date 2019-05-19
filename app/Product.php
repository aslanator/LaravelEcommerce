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
}
