<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="/tasks">Show All Tasks</a>
     -
    <a href="/taskcompleted/1">Show Completed Tasks</a>
     -
    <a href="/taskcompleted/0">Show Incomplete Tasks</a>

    <ul>
      @foreach ($tasks as $task)
        <a href="/task/{{ $task->id }}"><li>{{ $task->body }}</li></a>
      @endforeach
    </ul>

  </body>
</html>
