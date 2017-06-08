<?php

namespace App;

use Carbon\Carbon;

class Post extends GuardedFields
{

  # För att senare kunna använda $post = App\Post::find(2); $post->comments; ger alla kommentarer till post 2
  public function comments() {
    // return $this->hasMany(Comment::class);
    return $this->hasMany(Comment::class)->latest();
  }

  # För att senare kunna använda $post = App\Post::find(2); $post->user; ger author till post $post->user->name
  public function user() {
    return $this->belongsTo(User::class);
  }

  public function addComment($body) {
    $user_id = 1;
    $this->comments()->create(compact('body', 'user_id'));

    ### Metod 1 ###
    // Comment::create([
    //   'body' => request('body'),
    //   'post_id' => $post->id,
    //   'user_id' => 1
    // ]);

  }

  // custom ->eloquent selector som heter filter
  public function scopeFilter($query, $filters) { // $filters innehåller 'year' och 'month'
    // return $query->where('completed', $val);
    // dd($val);
    if ($month = $filters['month']) {
        $query->whereMonth('created_at', Carbon::parse($month)->month);
    }

    if ($year = $filters['year']) {
        $query->whereYear('created_at', Carbon::parse($year)->year);
    }
  }

}
