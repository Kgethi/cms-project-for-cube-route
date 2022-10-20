<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductsInCatergory;

class ProductController extends Controller
{
    //function to view the add product form
    public function viewProductForm()
    {

        $categories = Category::all();
        return view('product.addProduct')->with('categories', $categories);
    }

    //function to add product
    public function addProduct(Request $req)
    {

        $req->validate([
            'name' => 'required|unique:products,name',
            'slug' => 'required',
            'categories' => 'required',
            'variantName' => 'required|unique:variants,name',
            'sap_product_code' => 'unique',
            'web_product_code' => 'unique'
        ]);

        $categories = $req->categories;

        $product = new Product();
        $product->name = $req->name;
        $product->slug = $req->slug;
        $product->save();




        for ($i = 0; $i < count($categories); $i++) {
            $category_id = Category::where('name', $categories[$i])->first()->id;
            $product->catergories()->attach($category_id);
        }

        for ($i = 0; $i < count($req->variantName); $i++) {
            $variant = new Variant(['sap_product_code' => $req->sapProductCode[$i], 'web_product_code' => $req->webProductCode[$i], 'name' => $req->variantName[$i]]);
            $product->variants()->save($variant);
        }


        return redirect(route('products'))->with('message', 'Product has been added!');
    }

    //Function to delete a proudct
    public function deleteProduct(Request $req)
    {
        $productToDelete = Product::find($req->productID);
        $productToDelete->delete();
        return redirect(route('products'))->with('deleteMessage', 'Product has been deleted!');
    }

    //Function to edit a product
    public function editProduct($productID)
    {
        $categories = Category::all();
        $product = Product::find($productID);
        $productCategories = Product::find($productID)->catergories()->get();
        $productVariants =  Product::find($productID)->variants()->get();
        $categories = $categories->diff($productCategories);
        return view('product.editProduct')->with(['product' => $product, 'productCategories' => $productCategories, 'productVariants' => $productVariants, 'categories' => $categories]);
    }

    //Function to update the product
    public function updateProduct($productID, Request $req)
    {
        $req->validate([
            'name' => 'required|unique:products,name,' . $productID,
            'slug' => 'required',
            'variantName' => 'unique:variants,name'
        ]);

        $categories = $req->categories;
        $unlinkCategories = $req->categoriesDelete;
        $unlinkVariants = $req->variantsDelete;

        $product = Product::where('id', $productID)->first();

        $product->update(['name' => $req->name, 'slug' => $req->slug]);

        if (!empty($categories)) {
            for ($i = 0; $i < count($categories); $i++) {
                $category_id = Category::where('name', $categories[$i])->first()->id;
                $product->catergories()->attach($category_id);
            }
        }

        if (!empty($unlinkCategories)) {
            for ($i = 0; $i < count($unlinkCategories); $i++) {
                $category_id = Category::where('name', $unlinkCategories[$i])->first()->id;
                $product->catergories()->detach($category_id);
            }
        }


        for ($i = 0; $i < count($req->variantName); $i++) {
            if ($req->variantName[$i] != null) {
                $variant = new Variant(['sap_product_code' => $req->sapProductCode[$i], 'web_product_code' => $req->webProductCode[$i], 'name' => $req->variantName[$i]]);
                $product->variants()->save($variant);
            }
        }


        if (!empty($unlinkVariants)) {
            for ($i = 0; $i < count($unlinkVariants); $i++) {
                $unlinkVariant = Variant::where(['name' => $unlinkVariants[$i], 'product_id' => $productID])->delete();
            }
        }



        return redirect(route('products'))->with('message', 'Product has been updated!');
    }

    //Function to show all products
    public function showProducts()
    {
        $products = Product::all();

        return view('product.products')->with(['products' => $products]);
    }

    //Function to show all variants linked to this product
    public function showMyVariants($productID)
    {
        $product = Product::Find($productID)->first();
        $variants = $product->variants()->get();
        return view('variant.variantsInProduct')->with(['product' => $product, 'variants' => $variants]);
    }
}
