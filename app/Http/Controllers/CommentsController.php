<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post) { // istället för show($id) och för att specifiera "Post::find($id);" nedan. Namnet $post måste bvara samma som den som passeras genom Route web filen
      // $post = Post:find($id); //denna rad behövs ej om model routing är specificierad i funktions parametrarna

      // dd($post->id);

      $this->validate(request(), [
        'body' => 'required|min:4'    // required|min:20|max:20|
      ]);

      $post->addComment(request('body'));

      ### Metod 1 ###
      // Comment::create([
      //   'body' => request('body'),
      //   'post_id' => $post->id,
      //   'user_id' => 1
      // ]);

      // return redirect('/posts/'.$post->id);
      // Eller
      return back();

    }
}
