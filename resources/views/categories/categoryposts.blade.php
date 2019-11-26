@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
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

                            

                                <hr/>
                            @endforeach
                              @else
                              <p>No port available</p>
                          @endif
                      </div>


                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
