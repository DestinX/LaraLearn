<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class GuardedFields extends Eloquent
{
    // protected $fillable = ['title', 'body']; // Fält som är tillåtna

    # Eller

    protected $guarded = ['']; // Fält som INTE ska tillåtas, allt annat tillåts och kontrolleras förrutom $id som inte tillåts
}
