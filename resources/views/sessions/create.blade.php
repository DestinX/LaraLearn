@extends('layouts.master')

@section('title')
    <title>Login Page</title>
@endsection

@section('content')
<div class="row">
    <div class="container">

        <h1>Logga in</h1>

        @include('layouts.errors')

        <form class="" action="/login" method="post">
            {{ csrf_field() }}

            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">E-post</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Epost-adress" name="email">
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Lösenord</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Välj ett lösenord.." name="password">
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </div>

        </form>

    </div>
</div>
@endsection
