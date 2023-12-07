<?php

namespace App\Http\Controllers\Backend;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Helpers\slugGenerator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use slugGenerator;
    function viewCategory()
    {
        $categories = Category::latest()->paginate(20);
        $editCategory = null;
        return view('backend.categories.viewCategory',compact('categories','editCategory'));
    }
    function storeCategory(Request $request)
    {
        $category = new category();
        $category->title = $request->title;
        $category->slug = $this->generateSlug($request->title, Category::class);
        $category->save();
        return back();

        // dd(str($request->title)->slug);
    }
    function editCategory($slug)
    {
        $categories = Category::latest()->paginate(20);
        $editCategory = Category::where('slug',$slug)->first();
        return view('backend.categories.viewCategory',compact('categories','editCategory'));
    }
    function updateCategory($slug, Request $request)
    {
        $editCategory = Category::where('slug',$slug)->first();
        $editCategory->title = $request->title;
        $editCategory->save();
        return redirect()->route('category.show');
    }
    function deleteCategory($id)
    {
        Category::find($id)->delete();
        return back();
    }
}
