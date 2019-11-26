@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
      @if(session('response'))
          <div class="aler alert-success">{{session('response')}}</div>

      @endif
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default text-center">
                <div class="panel-heading">View Post</div>

                <div class="panel-body">

                  <div class="col-md-4">

                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="col-md-4 control-label">category</label>

                        <div class="col-md-8">
                            <select id="category_id" type="text" class="form-control" name="category_id" value="{{ old('category_id') }}" required >
                              @if(count($categories) > 0)
                                @foreach ($categories->all() as $category)
                                     <a href='{{ url("category/{$category->id}") }}'><option> {{$category->category}} </option></a>
                                 @endforeach

                              @endif

                    </select>
                            @if ($errors->has('categories_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('categories_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- <ul>

                        @if(count($categories) > 0)
                          @foreach($categories->all() as $category)
                            <li> <a href='{{ url("category/{$category->id}") }}'>{{ $category->$category }}</a> </li>
                          @endforeach
                        @else
                            <p>No category found!</p>
                        @endif

                    </ul> -->

                    </div>

                      <div class="col-md-8">
                          @if(count($posts) > 0)
                            @foreach($posts->all() as $post)
                                <h3>{{$post->post_title}}</h3>
                                <img src="{{$post->post_image}}" width="100%" height="350px" alt="">
                                <p>{{ $post->post_body }}</p>

                                <ul class="nav nav-pills">
                                  <li role="presentation">
                                  <a href="{{ url("/like/{$post->id}") }}"> <span class="fa fa-thumbs-up">Likes({{ $likeCtr}})</span> </a>
                                </li>
                                <li role="presentation">
                                <a href="{{url("/dislike/{$post->id}")}}"> <span class="fa fa-thumps-down">Dislike({{ $dislikeCtr }})</span> </a>
                              </li>
                              <li role="presentation">
                              <a href="{{url("/comment/{$post->id}")}}"> <span class="fa fa-comment-o"> Comment</span> </a>
                            </li>
                                </ul>

                                <hr/>
                            @endforeach
                              @else
                              <p>No port available</p>
                          @endif

                      <form class="form-horizontal" method="POST" action="{{ url("/comment/{$post->id}") }}" >
                          {{ csrf_field() }}


                          <div class="form-group{{ $errors->has('post_body') ? ' has-error' : '' }}">
                              <label for="comment" class="col-md-4 control-label">comment</label>

                              <div class="col-md-8">
                                  <textarea id="comment" rows="7" type="text" class="form-control" name="comment" value="{{ old('comment') }}" required >
                    </textarea>
                                  @if ($errors->has('comment'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('comment') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>





                          <div class="form-group">
                              <div class="col-md-8 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary">
                                    POST COMMENT
                                  </button>

                              </div>
                          </div>
                      </form>
                      <h3>Comment</h3>
                      @if(count($comments) > 0)
                        @foreach($comments->all() as $commnet)
                        <p>{{$commnet->comment}}</p>
                        <small>posted by: {{$commnet->name}}</small>
                        <hr />
                        @endforeach
                      @else
                      <p>No comment available!</p>
                      @endif

                    </div>

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
