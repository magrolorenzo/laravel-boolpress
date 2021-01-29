<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show($slug){

        // Cerco la categoria corrispondente in base allo slug
        $category = Category::where("slug",$slug)->first();

        if(!$category){
            abort(404);
        }
        // Faccio return della categoria
        return view("guest.categories.show", compact("category"));
    }
}
