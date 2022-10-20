<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['sap_product_code', 'web_product_code', 'name', 'slug'];
    public function catergories()
    {

        return $this->belongsToMany(Category::class, 'products_in_catergories');
    }

    public function variants()
    {

        return $this->hasMany(Variant::class);
    }
}
