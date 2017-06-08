<?php

namespace App\Http\Controllers;

use App\Task;
//use DB; // för --> $tasks = DB::table('tasks')->get();

class TasksController extends Controller
{
    public function index() {
      // $tasks = DB::table('tasks')->where('created_at', '>=')->get();
      // $tasks = DB::table('tasks')->where('user_id', '1')->get();
      // $tasks = DB::table('tasks')->get();
      // $tasks = DB::table('tasks')->latest()->get();  //hämta alla poster sortera efter senast först
      // $tasks = DB::table('tasks')->where('id', $id)->get();
      // $tasks = DB::table('tasks')->find($id);
      // return $tasks; //data passeras till view i json format

      // ELEQUENT
      $tasks = Task::all();
      return view('tasks.index', compact('tasks'));

      # METOD 1
      // return view('welcome', [
      //   'name' => 'Johan'
      // ]);

      # METOD 2
      // return view('welcome')->with('name', 'Johan');

      # METOD 3
      // $name = 'Johan';
      // $age = 45;
      // return view('welcome', compact('name', 'age'));

      # METOD 4
      // $tasks = [
      //   'fiska senare',
      //   'bada med ava',
      //   'klättra på berget.'
      // ];
      // return view('welcome', compact('tasks'));
    }

    public function show(Task $task) { // istället för show($id) och för att specifiera "Task::find($id);" nedan.
      // $task = Task::find($id); //denna rad behövs ej om model routing är specificierad i funktions parametrarna
      // return $task;
      return view('tasks.show', compact('task'));
    }

    public function completed($isCompleted) {
      // $isCompleted = 1;
      // $tasks = Task::incomplete($param_getcompleted)->get();
      // $tasks = Task::incomplete()->get(); // utan extra parameter
      $tasks = Task::incomplete($isCompleted)->where('id', '>=', 1)->get();

      //return $tasks; //kommer ut i json format
      return view('tasks.index', compact('tasks'));
    }
}
