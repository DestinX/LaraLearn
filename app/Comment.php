<?php

namespace App;

class Comment extends GuardedFields
{
    /*
      I tinker eller i controllers. Tar fram vilken post kommentaren tillhör.

      $comment = App\Comment::find(1);
      $comment->post
      $comment->post->title

      $comment->post->user //ger användare till posten som kommenterdes, se Post->user()
    */
    public function post() {
      return $this->belongsTo(Post::class);
    }

    /*
      I tinker eller i controllers. Tar fram vilken användare kommentaren tillhör.

      $comment = App\User::find(1);
      $comment->user
      $comment->user->name
    */
    public function user() {
      return $this->belongsTo(User::class);
    }
}
