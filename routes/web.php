<?php
######## POSTS / BLOGGEN ###############
Route::get('/', 'PostsController@index')->name('home'); //home för att använda i redirects tex return redirect()->home();
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts', 'PostsController@index');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts/{post}/comment', 'CommentsController@store');


############ Custom Login ###############
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');


######################### Genererad login / Auth ############################
// #Auth::routes(); // Routes för /login / register
// #Route::get('/home', 'HomeController@index')->name('home');


############## JSON Tester ##############################
use App\Post;
use App\Comment;
Route::get('/json', function () {
    // $posts = Post::all();
    // return $posts;
    $com = Comment::pluck('body');
    return $com;
});
Route::get('/test', function () {
    // $com = DB::table('posts')->find(1);
    // $com = DB::table('posts')->count();
    // $com = DB::table('posts')->distinct()->get();
    // $com = DB::table('posts')
    //         ->join('comments', 'posts.id', '=', 'comments.post_id')
    //         ->select('posts.id', 'comments.*', 'comments.body')
    //         ->get();
    return $com;
});
/*
BASIC STRUCTURE
- Eloquent Model - php artisan make:model Post  ||  php artisan make:model Post -mc
- Controller - php artisan make:controller PostsController
- Resourcefull Contoller - php artisan make:controller PostsController -r
- Migration - php artisan make:migration create_posts_table --create=posts
*/
/*
BASIC STRUCTURE POSTS GET DELETE PATCH
---------------
GET /posts
GET /posts/create
POST /posts
GET /posts/{id}/edit
GET /posts/{id}
PATCH /posts/{id}
DELETE /posts/{id}

Skapa en resourcefull Controller med alla ovan funktioner
# php artisan make:controller TasksController -r
*/

### TASKS MED EGNA FUNKTIONER I MODEL ####
Route::get('/tasks', 'TasksController@index');
Route::get('/task/{task}', 'TasksController@show');
Route::get('/taskcompleted/{trueorfalse}', 'TasksController@completed');

// use App\Task;

// # FLYTTAD TILL CONTROLLER
// Route::get('/tasks', function () {
//     $tasks = Task::all();
//     return view('tasks.index', compact('tasks'));
// });

# FLYTTAD TILL CONTROLLER
// Route::get('/task/{task}', function ($id) {
//   $task = Task::find($id);
//   return view('tasks.show', compact('task'));
// });

# FLYTTAD TILL CONTROLLER
// Route::get('/taskcompleted', function () {
//   $param_getcompleted = 1;
//   $tasks = Task::incomplete($param_getcompleted)->where('id', '>=', 1)->get();
//   return view('tasks.index', compact('tasks'));
// });
