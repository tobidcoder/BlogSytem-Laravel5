<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Post;
use App\Like;
use App\Dislike;
use App\Comment;
USE App\Profile;
use Auth;
class postController extends Controller
{
  public function post(){
    $categories = Category::all();


    // return $category;
    // exit();
     return view('posts.post', ['categories' => $categories]);
  }

  public function addPost(Request $request){
    // return $request->input('post_title');
    $this->validate($request, [
      'post_title' => 'required',
      'post_body' => 'required',
      'category_id' => 'required',
      'post_image' => 'required'
    ]);
    // return 'Validation over pass';
    $posts = new Post;
    $posts->post_title =$request->input('post_title');
    $posts->user_id = Auth::user()->id;
    $posts->post_body =$request->input('post_body');
    $posts->category_id =$request->input('category_id');
      if(Input::hasFile('post_image')){
        $file = Input::file('post_image');
        $file->move(public_path(). '/posts/', $file->getClientOriginalName());
      $url= URL::to("/") . '/posts/'. $file->getClientOriginalName();
        // return $url;
        // exit;

      }
    $posts->post_image =$url;
    $posts->save();
    return redirect ('/home')->with('response', 'Post added succesfully');
    // return Auth::user()->id;
    // exit();
  }


//get all post to blogpost images
  public function blogspost(){
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $categories = Category::all();
         return view('blogpost', ['categories' => $categories, 'posts' => $posts ]);
      }



  public function view($post_id)
  {
    // return $post_id;
    $posts = Post::where('id', '=', $post_id)->get();
    $likePost = Post::find($post_id);
    $likeCtr = Like::where(['post_id' => $likePost->id])->count();
    $dislike = Post::find($post_id);
    $dislikeCtr = Dislike::where(['post_id' => $dislike->id])->count();
   $categories = Category::all();    // return $categories;
    // exit();
    $comments = DB::table('users')
      ->join('comments', 'users.id', '=', 'comments.user_id')

      ->join('posts', 'comments.post_id', '=', 'posts.id')
      ->select('users.name', 'comments.*')
      ->where(['posts.id' => $post_id])
      ->orderBy('comments.id', 'desc')
      ->get();
      // return $comments;
      // exit();
      return view('posts.view', ['posts' => $posts, 'categories' => $categories, 'likeCtr' => $likeCtr, 'dislikeCtr' => $dislikeCtr, 'comments' => $comments]);

    // return $post;
  }

  public function edit($post_id)
  {
    $categories = Category::all();

    $posts = Post::find($post_id);
    $category = Category::find($posts->category_id);
    // return $posts;
    // exit();

    return view('posts.edit', ['categories' => $categories, 'posts' => $posts, 'category' => $category]);
  }

  public function editPost(Request $request, $post_id)
  {
    $this->validate($request, [
      'post_title' => 'required',
      'post_body' => 'required',
      'category_id' => 'required',
      'post_image' => 'required'
    ]);
    // return 'Validation over pass';
    $posts = new Post;
    $posts->post_title =$request->input('post_title');
    $posts->user_id = Auth::user()->id;
    $posts->post_body =$request->input('post_body');
    $posts->category_id =$request->input('category_id');
      if(Input::hasFile('post_image')){
        $file = Input::file('post_image');
        $file->move(public_path(). '/posts/', $file->getClientOriginalName());
      $url= URL::to("/") . '/posts/'. $file->getClientOriginalName();
        // return $url;
        // exit;

      }
    $posts->post_image =$url;
    $data = array(
      'post_title' => $posts->post_title,
      'user_id' => $posts->user_id,
      'post_body' => $posts->post_body,
      'category_id' => $posts->category_id,
      'post_image' => $posts->post_image
    );
    Post::where('id', $post_id)
      ->update($data);
    $posts->update();
    return redirect ('/home')->with('response', 'Post updated succesfully');
    // return Auth::user()->id;
    // exit();
  }

  public function deletePost($post_id)
  {
    // return $post_id;
      Post::where('id', $post_id)
        ->delete();
      return redirect ('/home')->with('response', 'Post Deleted succesfully succesfully');
  }

  public function category($categor9y_id){
    $categories = Category::all();
    // return $categor9y_id;
    $posts = DB::table('posts')
      ->join('Categories', 'posts.category_id', '=', 'categories.id')
      ->select('posts.*', 'categories.*')
      ->where(['categories.id' => $categor9y_id])
      ->get();
    return view('categories.categoryposts', ['categories' => $categories, 'posts' => $posts]);
  }

  public function like($id){
    // return $id;
    $logged_user =Auth::user()->id;
    $like_user = Like::where(['user_id' => $logged_user, 'post_id' => $id])->first();
    if(empty($like_user->user_id)){
      $user_id = Auth::user()->id;
      $email = Auth::user()->email;
      $post_id = $id;

      $like = new Like;
      $like->user_id = $user_id;
      $like->email = $email;
      $like->post_id = $post_id;
      $like->save();
        return redirect("/view/{$id}");
    }else {
      return redirect("/view/{$id}");
    }
  }

  public function dislike($id){
    // return $id;
    $logged_user =Auth::user()->id;
    $like_user = Dislike::where(['user_id' => $logged_user, 'post_id' => $id])->first();
    if(empty($like_user->user_id)){
      $user_id = Auth::user()->id;
      $email = Auth::user()->email;
      $post_id = $id;

      $like = new Dislike;
      $like->user_id = $user_id;
      $like->email = $email;
      $like->post_id = $post_id;
      $like->save();
        return redirect("/view/{$id}");
    }else {
      return redirect("/view/{$id}");
    }
  }

  public function comment(Request $request,  $post_id){
    // return $post_id;
    $this->validate($request, [
      'comment' => 'required'
      ]);
      $comment = new Comment;
      $comment->user_id = Auth::user()->id;
      $comment->post_id = $post_id;
      $comment->comment = $request->input('comment');
      $comment->save();
      return redirect("/view/{$post_id}")->with('response', 'Comment added succesfully');
  }

  public function search(Request $request){
    // return $request->input('search');
    $user_id = Auth::user()->id;
    $profile = Profile::find($user_id);
    $keyword = $request->input('search');
    $posts = Post::where('post_title', 'LIKE', '%'.$keyword. '%')->get();
      // return $post;
      // exit()
      return view('posts.searchpost', ['profile' => $profile, 'posts' => $posts]) ;
  }
}
