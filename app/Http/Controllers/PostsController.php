<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use Carbon\Carbon;

class PostsController extends Controller
{
    public function __construct() {
      /*
        'auth'        -> Inloggning krävs
        'auth.basic'  ->
        'bindings'    ->
        'can'         -> om user has tillstånd eller specifik roll
        'guest'       -> visas inte om man är inloggad, visas endast för utloggade
        'throttle'    ->

        Exempel:
        $this->middleware('auth');  // Alla metoder i controllern
        $this->middleware('auth', ['only' => 'index']);  // endast index metoden i controller
        $this->middleware('auth', ['except' => 'index']);  // allt förrutom index metoden i controller
        $this->middleware('auth')->except(['index', 'show']); // samma som ovan
      */

      $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        /*
        --> Post::all();                                  Visar alla poster i databasen
        --> Post::where('id', '>', 1)->get();             Visar poster med villkor
        --> Post::pluck('body');                          Plockar fram ett fält från databastabellen
        --> Post::pluck('body')->first();                 Plockar fram ett fält från databastabellen
        --> Post::where('completed', 0)->get();           Plockar fram med villkor completed = false
        --> Post::orderBy('created_at', 'desc')->get()    Order by..
        --> Post::latest()->get()                         Visar senast skapad post först.
        --> Post::oldest()->get()                         Visar tidigast skapade posts först.
        */

        // $posts = Post::orderBy('created_at', 'desc')->get();
        ### ELLER
        // $posts = Post::oldest()->get();
        ### ELLER
        // $posts = Post::oldest();
        // if ( $month = request('month') ) {
        //     //->month ->year ->day | omvandlar maj = 5
        //     $posts->whereMonth('created_at', Carbon::parse($month)->month);
        // }
        //
        // if ( $year = request('year') ) {
        //     //->month ->year ->day | omvandlar maj = 5
        //     $posts->whereYear('created_at', Carbon::parse($year)->year);
        // }
        // $posts = $posts->get();
        ### ELLER utföra smma sak i model "Post" med hjälp av scopes
        ### filter som är en custom scope måste ha classen scopeFilter i Post model.
        ### request passeras vidare till scopeFilter classen som $val
        $posts = Post::oldest()
            ->filter(request(['month', 'year']))
            ->get();

        /*
            SELECT year(created_at) as year,
            	   monthname(created_at) as month,
                   count(*)
            FROM posts
            GROUP BY year, month
            ORDER BY min(created_at) desc

            SelectRaw - för egna selects i sql format
            orderByRaw - för egna sql

            App\Post::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) published')->groupBy('year', 'month')->get();
        */

        $archives = Post::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) published')
                ->groupBy('year', 'month')
                ->orderByRaw('min(created_at) desc')
                ->get()
                ->toArray();
        // return $archives;

        return view('posts.index', compact('posts', 'archives'));
    }

    public function show(Post $post) { // istället för show($id) och för att specifiera "Post::find($id);" nedan. Namnet $post måste bvara samma som den som passeras genom Route web filen
      // $post = Post:find($id); //denna rad behövs ej om model routing är specificierad i funktions parametrarna
      // return $post;
      return view('posts.show', compact('post'));
    }

    public function create() {
      return view('posts.create');
    }

    public function store() {
      /*
      STABDARD PROCEDUR VID LAGRING
        1. Skapa/Hämta post
        2. Spara till databas
        3. Redirect till startsida
      */

      // dd(request()->ALL());
      // dd(request()->title);
      // dd( request(['title', 'body']) );

      # Metod 1 - Skapa post i databasen
      // $post = new Post;
      // $post->title = request('title');
      // $post->body = request('body');
      // $post->save();

      # Eller

      # VALIDERING
      # Automatisk validering, returnerar $errors till vy om validering misslyckas
      $this->validate(request(), [
        'title' => 'required', // required|min:20|max:20|
        'body' => 'required'
      ]);

      ### Metod 1
      # Skapa post i databasen - korresponderar mot Post model som är kopplad till posts tabellen i db
      // Post::create(request(['title', 'body']));
      # ELLER
      // Post::create([
      //   'title' => request('title'),
      //   'body' => request('body'),
      //   'user_id' => auth()->id() // eller ---> auth()->user()->id
      // ]);

      ### Metod 2
      # ELLER använda helper funktion för redan authenticerad användare ( för att slippa skriva in user_id )
      # Metoden publish() måste såklart finnas med i User model
      auth()->user()->publish(
        new Post(request(['title', 'body']))
      );


      // return redirect('/');
      return redirect()->home();
    }
}
