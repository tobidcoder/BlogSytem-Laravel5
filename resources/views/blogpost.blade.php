@extends('layouts.app')
<style type="text/css">
  .avatar{
    border-radius: 100%;
    max-width: 100px;
  }
</style>

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
          <!-- alert code  -->
          @if(count($errors) > 0)
              @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{$error}} </div>
                @endforeach
                  @endif
              @if(session('response'))
                      <div class="alert alert-success">{{session('response')}}
                      </div>
              @endif
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-4">Dashborad     </div>
                <div class="col-lg-8">



                <form class="form-horizontal" method="POST" action="{{ url("/search") }}" >
                    {{ csrf_field() }}

                    <div class="input-group">
                      <input type="text" name="search" value="" class="form-control" placeholder="Serach for....">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"> Go</button>
                      </span>

                    </div>
                </form>
              </div>
              </div>
              </div>
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

                        </div>
                    </div>

                    </div>

                    <div class="col-md-8">
                        @if(count($posts) > 0)
                          @foreach($posts->all() as $post)
                              <h3>{{$post->post_title}}</h3>
                              <img src="{{$post->post_image}}" width="100%" height="350px" alt="">
                              <p>{{substr($post->post_body, 0, 150)}}</p>

                              <ul class="nav nav-pills">
                                <li role="presentation">
                                <a href="{{ url("/view/{$post->id}") }}"> <span class="fa fa-eye">View</span> </a>
                              </li>
                              @if(Auth::id() == 1)
                              <li role="presentation">
                              <a href="{{url("/edit/{$post->id}")}}"> <span class="fa fa-pencil-square-0">Edit</span> </a>
                            </li>
                            <li role="presentation">
                            <a href="{{url("/delete/{$post->id}")}}"> <span class="fa fa-trash"> Delete</span> </a>
                          </li>
                          @endif
                              </ul>
                              <cite style="float:left;">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}}</cite>
                              <hr/>
                          @endforeach
                            @else
                            <p>No port available</p>
                        @endif
                        {{$posts->links()}}
                    </div>

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
