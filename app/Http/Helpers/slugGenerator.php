<?php

namespace App\Http\Helpers;


trait slugGenerator{
    public function generateSlug($title,$model){
        $count=$model::where('slug', 'LIKE', '%'. str($title)->slug() . '%')->count();
        // dd($count);
        if($count>0){
            $count++;
            return $slug = str($title)->slug() . '-' . $count;
        }else{
            return $slug = str($title)->slug();
        }
    }
}