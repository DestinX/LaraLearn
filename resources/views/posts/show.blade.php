@extends('layouts.master')



@section('title')
<title>Visar post</title>
@endsection




@section('content')
<div class="blog-header">
  <div class="container">
    <h1 class="blog-title">{{ $post->title }}</h1>
    <p class="lead blog-description">{{ $post->body }}</p>
  </div>
</div>

<div class="container">

  <div class="row">

    <div class="col-sm-8 blog-main">


      <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="#">Chris</a></p>

        <p>{{ $post->body }}</p>
      </div><!-- /.blog-post -->

      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="/">Backa</a>
      </nav>

      <div class="card">
        <div class="card-block">

          @include('layouts.errors')

          <form action="/posts/{{ $post->id }}/comment" method="post">

            {{ csrf_field() }}

            <textarea name="body" placeholder="kommentera här.." class="form-control"></textarea>
            <br>
            <button type="submit" class="btn btn-primary">Skicka</button>

          </form>
        </div>
      </div>

      <div class="comments">
          @foreach ($post->comments as $comment)
            <hr>
            <article>
              <!-- ÄNDRA PRÅKET PÅ DIFFFORHUMANS -> app/providers/AppServiceProvider.php
              use Carbon\Carbon;
              Carbon::setLocale('se'); -->
              <strong>Skapad: {{ $comment->created_at->diffForHumans() }}: </strong>
              <p>{{ $comment->body }}</p>
            </article>
          @endforeach
          <hr>
      </div>

    </div><!-- /.blog-main -->

    <div class="col-sm-3 offset-sm-1 blog-sidebar">
      <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
          <li><a href="#">March 2014</a></li>
          <li><a href="#">February 2014</a></li>
          <li><a href="#">January 2014</a></li>
          <li><a href="#">December 2013</a></li>
          <li><a href="#">November 2013</a></li>
          <li><a href="#">October 2013</a></li>
          <li><a href="#">September 2013</a></li>
          <li><a href="#">August 2013</a></li>
          <li><a href="#">July 2013</a></li>
          <li><a href="#">June 2013</a></li>
          <li><a href="#">May 2013</a></li>
          <li><a href="#">April 2013</a></li>
        </ol>
      </div>
      <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </div><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</div><!-- /.container -->
@endsection
