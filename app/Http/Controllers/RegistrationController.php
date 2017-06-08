<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class RegistrationController extends Controller
{
      public function create() {
          return view('registration.create');
      }

      public function store() {

        $this->validate(request(), [
          'name' => 'required', // required|min:20|max:20|
          'email' => 'required|email',
          'password' => 'required|confirmed' // |confirmed| validering kräver 2 fält i form där bekräfta fältet ska heta password_confirmation
        ]);

        # Skapa post i databasen - korresponderar mot Post model som är kopplad till posts tabellen i db
        // $user = User::create(request(['name', 'email', 'password']));
        # Eller - för att att ha med bcrypt()
        $user = User::create([
          'name' => request('name'),
          'email' => request('email'),
          'password' => bcrypt(request('password'))
        //   'created_at' => DB::raw('now()'),
        //   'updated_at' => DB::raw('now()')
        ]);

        // Fasad, logga in användaren ovan!
        // \Auth::login();
        // eller för att slippa registrera Auth (use \Auth) använda helper funktion
        auth()->login($user);

        // return redirect('/');
        return redirect()->home();
      }
}
