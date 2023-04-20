<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function attributes(){
       return $this->hasMany('App\Models\ProductsAttribute','product_id');
    }
}
