<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;
class profileController extends Controller
{
    public function profile(){
      return view('/profile.profile');
    }
  public function addProfile(Request $request){
      // return $request->input('name');
      $this->validate($request, [
        'name' => 'required',
        'designation' => 'required',
        'profile_pic' => 'required'
      ]);
      $profile = new Profile;
      $profile->name =$request->input('name');
      $profile->user_id = Auth::user()->id;
      $profile->designation =$request->input('designation');
        if(Input::hasFile('profile_pic')){
          $file = Input::file('profile_pic');
          $file->move(public_path(). '/uploads/', $file->getClientOriginalName());
        $url= URL::to("/") . '/uploads/'. $file->getClientOriginalName();
          // return $url;
          // exit;

        }
      $profile->profile_pic =$url;
      $profile->save();
      return redirect ('/home')->with('response', 'profile added succesfully');
      // return Auth::user()->id;
      // exit();

  }
}
