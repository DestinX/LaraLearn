@extends('layouts.master')



@section('title')
<title>Skapa en post</title>
@endsection




@section('content')
<div class="blog-header">
  <div class="container">
    <h1 class="blog-title">Skapa ny post</h1>
    <p class="lead blog-description">Skapa en ny post att visa på bloggen.</p>
  </div>
</div>

<div class="container">

  <div class="row">

    <div class="col-sm-8 blog-main">

      <div class="blog-post">

        <div class="container">

          <!-- Errors från PostsController, om validering misslyckas. -->
          @include('layouts.errors')

          <form method="POST" action="/posts">

            {{ csrf_field() }}

            <div class="form-group row">
              <label for="title" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="Title" name="title">
              </div>
            </div>
            <div class="form-group row">
              <label for="body" class="col-sm-2 col-form-label">Bodu</label>
              <div class="col-sm-10">
                <textarea id="body" name="body" class="form-control"></textarea>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </div>
          </form>

        </div>

      </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

  </div><!-- /.row -->

</div><!-- /.container -->
@endsection
