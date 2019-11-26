<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\user;
use App\Post;
use Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Getting post that belogs to a users
      $user_id = Auth::user()->id;
      $profile = DB::table('users')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->select('users.*', 'profiles.*')
                ->where(['profiles.user_id' => $user_id])
                ->first();
                // return $profile->name;
                // exit();
          //get all post with paginate
                $posts = Post::orderBy('id', 'desc')->paginate(5);
                // return $posts;
                // exit();
        return view('home', ['profile' => $profile, 'posts' =>$posts]);
    }


}
