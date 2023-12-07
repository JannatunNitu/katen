<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\slugGenerator;
use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubController extends Controller
{
    use slugGenerator;
    function viewSubcategory(){
        $subCategories = SubCategory::with('category')->get();
        $categories = Category::select('id', 'title')->latest()->get();
        // dd($categories);
        return view ('backend.categories.viewSubCategory', compact('categories','subCategories'));
    }
    function storeSubcategory(Request $request)
    {
        $sub = new SubCategory();
        $sub->category_id = $request->category_id;
        $sub->title = $request->title;
        $sub->slug = $this->generateSlug($request->title, SubCategory::class);
        $sub->save();
        return back();
    }

    function getSubCategory(Request $request){
        $subCategories = subCategory::where('category_id', $request->categoryId)->get();
        return $subCategories;
    }
}
