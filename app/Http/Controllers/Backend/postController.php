<?php

namespace App\Http\Controllers\Backend;

use App\Models\post;
use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Helpers\slugGenerator;
use App\Http\Controllers\Controller;
use App\Http\Helpers\mediaUploader;

class postController extends Controller
{
    use slugGenerator, mediaUploader;
    function addPost(){
        $categories = category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        return view('backend.posts.addPost', compact('categories','subCategories'));
    }
    function storePost(Request $request)   
    {
        // dd($request->all());
        // VALIDATION
       $request->validate(
        [
           'title' => 'required|max:30',
           'featured_img' => 'nullable|mimes:png,jpg',
           'content' => 'nullable|max:256'
        ],
        [
          'title.required' => "Please enter your title",
          'featured_img.required' => "Image extention must be png or jpg",
          'content.required' => "Content must be under 256 character"
        ]
        );



    // *IMAGE STORE
    $title = $this->generateSlug($request->title,post::class);
    $fileName = $this->uploadSingleMedia($title, $request->featured_img);
    

    $post = new post();
    $post->title = $request->title;
    $post->slug = $title;
    $post->user_id = auth()->user()->id;
    $post->category_id = $request->category;
    $post->sub_category_id = $request->subcategory;
    $post->featured_img = $fileName;
    $post->content = $request->content;
    
    $post->save();
    return back();

    }


    function getAllPost(){
        $posts = post::where('user_id', auth()->user()->id)->get();
        return view('backend.posts.allPost', compact('posts'));
    }

    function updatePost(Request $request){
        $id = $request->postStatus;
        $posts = post::find($request->id);
        if ($posts->is_popular == 0){
            $posts->is_popular = 1;
           
            $posts->save();
            return 'success';
        } else {
            $posts->is_popular = 0;
            $posts->save();
            return 'false';
        }
        dd($request->is_popular);
        
        return view('backend.posts.allPost', compact('posts'));
    }
}
