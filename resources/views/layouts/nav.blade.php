<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">


            <a class="nav-link active" href="{{ url('/') }}">Home</a>
            <a class="nav-link" href="{{ url('/posts/1') }}">Post ID_1</a>
            <a class="nav-link" href="{{ url('/posts/create') }}">Skapa Post</a>
            <!-- <a class="nav-link" href="route('login')">Login</a> -->

            @if (! Auth::check())
                <a class="nav-link" href="{{ url('/register') }}">Skapa Konto</a>
                <a class="nav-link" href="{{ url('/login') }}">Login</a>
            @else
                <a class="nav-link ml-auto" href="#">Hej, {{ Auth::user()->name }}</a>
                <a class="nav-link ml-auto" href="{{ url('/logout') }}">logout</a>
            @endif

            @if (Auth::guest())
                <a class="nav-link ml-auto" href="#">Välkommen Gäst</a>
            @endif

        </nav>
    </div>
</div>
