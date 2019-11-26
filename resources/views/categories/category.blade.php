@extends('layouts.app')

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
            <div class="panel panel-default">
                <div class="panel-heading">category</div>


                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ url('/addCategory') }}">
                      {{ csrf_field() }}

                      <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                          <label for="categories" class="col-md-4 control-label">Enter Category</label>

                          <div class="col-md-6">
                              <input id="category" type="category" class="form-control" name="category" value="{{ old('category') }}" required autofocus>

                              @if ($errors->has('category'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('category') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>




                      <div class="form-group">
                          <div class="col-md-8 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Add Categories
                              </button>


                          </div>
                      </div>
                  </form>


            <div class="col-md-4">

              <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label for="category_id" class="col-md-4 control-label">category list</label>

                  <div class="col-md-8">
                      <select id="category_id" type="text" class="form-control" name="category_id" value="{{ old('category_id') }}" required >
                        @if(count($category) > 0)
                          @foreach ($category->all() as $category)
                               <a href='{{ url("category/{$category->id}") }}'><option> {{$category->category}} </option></a>
                           @endforeach

                        @endif

              </select>

                  </div>
              </div>

              </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
