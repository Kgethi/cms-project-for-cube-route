<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    //Function to view all categories
    public function viewCategories()
    {
        $categories = Category::all();
        return view('category.categories')->with('categories', $categories);
    }

    //Function to delete a category
    public function deleteCategory(Request $req)
    {
        $categoryToDelete = Category::find($req->categoryID);
        $categoryToDelete->delete();
        return redirect(route('categories'))->with('deleteMessage', 'Category has been deleted!');
    }

    //function to edit a category
    public function editCategory($categoryID)
    {
        $category = Category::find($categoryID);
        return view('category.editCategory')->with('category', $category);
    }

    //function to update a category
    public function updateCategory($categoryID, Request $req)
    {

        $req->validate([
            'name' => 'required|unique:categories,name,' . $categoryID,
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required'
        ]);


        $category = Category::where('id', $categoryID)->update(['name' => $req->name, 'meta_title' => $req->title, 'meta_description' => $req->description, 'meta_keywords' => $req->keywords]);


        return redirect(route('categories'))->with('message', 'Category has been updated!');
    }

    //Function to view add category form
    public function viewCategoryForm()
    {

        return view('category.addCategory');
    }


    //Function to add category
    public function addCategory(Request $req)
    {

        $req->validate([
            'name' => 'required|unique:categories',
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required'
        ]);

        $category = new Category();
        $category->name = $req->name;
        $category->meta_title = $req->title;
        $category->meta_description = $req->description;
        $category->meta_keywords = $req->keywords;
        $category->save();

        return redirect(route('categories'))->with('message', 'Category has been added!');
    }

    //Function to show products in category
    public function showMyProducts($categoryID)
    {
        $category = Category::find($categoryID);
        $products = Category::find($categoryID)->products()->get();
        return view('product.productsInCategory')->with(['products' => $products, 'category' => $category]);
    }
}
