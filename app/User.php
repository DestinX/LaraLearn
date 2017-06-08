<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function publish(Post $post) { // passeras från PostsController@store

      ### Metod 1
      $this->posts()->save($post);
      # ELLER om man inte har en hel post som passeras in via PostsController
      // $this->posts()->create([
      //     'title' => request('title'),
      //     'body' => request('body'),
      //     'user_id' => auth()->id()
      // ]);

      ### Metod 2
      // Post::create([
      //   'title' => request('title'),
      //   'body' => request('body'),
      //   'user_id' => auth()->id() // eller ---> auth()->user()->id
      // ]);

    }
}
