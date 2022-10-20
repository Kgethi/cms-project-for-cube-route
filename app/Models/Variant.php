<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = ['sap_product_code', 'web_product_code', 'name'];
    public $timestamps = false;
    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}
