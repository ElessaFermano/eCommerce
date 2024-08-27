<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
   public function suppliers(){
    return view('supplier');
   }
}
