<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    protected $fillable = ['title', 'alt', 'url'];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
