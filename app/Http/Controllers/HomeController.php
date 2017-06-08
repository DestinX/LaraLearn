<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        */

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ######### Skapa ny default User metod 1 ###########
        // $user = new User;
        // $user->name = 'Adminsson';
        // $user->email = 'admin@admin.com';
        // $user->password = bcrypt('admin');
        // $user->save();

        ######### Skapa ny default User metod 2 ###########
        // User::create([
        //   'name' => 'Adminsson',
        //   'email' => 'admin@admin.com',
        //   'password' => bcrypt('admin'),
        //   'created_at' => DB::raw('now()'),
        //   'updated_at' => DB::raw('now()')
        // ]);

        return view('home');
    }
}
