<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class categoryController extends Controller
{
    public function category(){
      return view('/categories.category');
    }

    public function addCategory(Request $request){
      // return $request->input('category');
      $this->validate($request, [
        'category' => 'required'
      ]);
      // return ' Validation pass';
      $category = new Category;
      $category->category = $request->input('category');
      $category->save();
       return redirect('/category')->with('response', 'categories added successfully');
    }
}
