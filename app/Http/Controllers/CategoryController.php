<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showcategory(){
        return view('category.categories');
    }
    //
}
