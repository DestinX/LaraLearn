<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    public function isComplete() {

      return false;

    }

    // Endast statiska querys, kan inte sätta fler villkor senare i route vy
    public static function inteklar() {

      return Task::where('completed', 0)->get();
      // eller nedan, eftersom Task är classen är i samma fil
      // return static::where('completed', 0)->get();

    }

    // App\Task::incomplete()->get();
    // public function scopeIncomplete($query) {
    public function scopeIncomplete($query, $val) {
      // return $query->where('completed', 0);
      return $query->where('completed', $val);
    }

    public static function makeLink($link) {
        if (str_contains(url('/'), '8000'))
            return $link;
        else
            return '/public'.$link;
    }



}
