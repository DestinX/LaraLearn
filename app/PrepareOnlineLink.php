<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrepareOnlineLink extends Model
{

    public static function make($link) {
        if (str_contains(url('/'), '8000'))
            return $link;
        else
            return url('/public').$link;
    }

}
