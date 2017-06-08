<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">


            <a class="nav-link active" href="/">Home</a>
            <a class="nav-link" href="/posts/1">Post ID_1</a>
            <a class="nav-link" href="/posts/create">Skapa Post</a>
            <!-- <a class="nav-link" href="route('login')">Login</a> -->

            @if (! Auth::check())
                <a class="nav-link" href="/register">Skapa Konto</a>
                <a class="nav-link" href="/login">Login</a>
            @else
                <a class="nav-link ml-auto" href="#">Hej, {{ Auth::user()->name }}</a>
                <a class="nav-link ml-auto" href="/logout">logout</a>
            @endif
            
        </nav>
    </div>
</div>
