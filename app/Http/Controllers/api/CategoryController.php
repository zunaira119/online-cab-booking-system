<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
  public function carCategories(Request $request)
  {
      $categories=Category::all();
       
      return response()->json([
        'data'=>$categories,
        'status'=>true
    ]);
  }
}