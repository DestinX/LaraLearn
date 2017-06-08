@extends('layouts.master')



@section('title')
<title>Start</title>
@endsection




@section('content')
<div class="blog-header">
  <div class="container">
    <h1 class="blog-title">Startsidan</h1>
    <p class="lead blog-description">Startsidan finner du här.</p>
  </div>
</div>

<div class="container">

  <div class="row">

    <div class="col-sm-8 blog-main">

      <!-- CARBON FORMATER
      $dt = Carbon::create(1975, 12, 25, 14, 15, 16);

      var_dump($dt->toDateTimeString() == $dt);          // bool(true) => uses __toString()
      echo $dt->toDateString();                          // 1975-12-25
      echo $dt->toFormattedDateString();                 // Dec 25, 1975
      echo $dt->toTimeString();                          // 14:15:16
      echo $dt->toDateTimeString();                      // 1975-12-25 14:15:16
      echo $dt->toDayDateTimeString();                   // Thu, Dec 25, 1975 2:15 PM

      // ... of course format() is still available
      echo $dt->format('l jS \\of F Y h:i:s A');         // Thursday 25th of December 1975 02:15:16 PM' -->

      @foreach ($posts as $post)
        <div class="blog-post">
          <h2 class="blog-post-title"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
          <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="#">{{ $post->user->name }}</a></p>
          <p>{{ $post->body }}</p>
        </div>
      @endforeach

      <div id="example-react-comments"></div>

      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
      </nav>

    </div><!-- /.blog-main -->

    <div class="col-sm-3 offset-sm-1 blog-sidebar">
      <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            @foreach($archives as $stats)
                <li><a href="/?month={{ $stats['month'] }}&year={{ $stats['year'] }}">
                    {{ $stats['month'] . ' ' . $stats['year'] }}
                </a></li>
            @endforeach
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
