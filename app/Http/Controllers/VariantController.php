<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    //Function to delete variant
    public function deleteVariant(Request $req)
    {
        Variant::where(['name' => $req->variantName, 'product_id' => $req->productID])->delete();
        return redirect(route('variants'))->with('deleteMessage', 'Variant has been deleted!');
    }

    //Function to show all variants
    public function showVariants()
    {
        $variants = Variant::all();
        return view('variant.variants')->with(['variants' => $variants]);
    }
}
