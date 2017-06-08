<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
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

    //   $this->middleware('guest')->only(['create', 'store']);
    //   $this->middleware('auth')->only(['destroy']);
      $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create() {
        return view('sessions.create');
    }

    public function store() {
        // Authenticera användaren

        // Kontrollera ancändar data och logga in denna via auth, redirect tillbaka om fail
        if (! auth()->attempt(request(['email', 'password'])) ) {
            return back()->withErrors([
                'messagea' => 'Vänligen kontrollera uppgifterna och prova igen.'
            ]);
        }

        // Om användaren INTE anger fel detaljer ovan, loggas denne in och redirectas sedan till home
        return redirect()->home();

    }

    public function destroy() {
        // Helper funktion för logout
        auth()->logout();

        return redirect()->home();
    }
}
