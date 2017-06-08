@extends('layouts.master')

@section('title')
<title>Register User</title>
@endsection

@section('content')
<div class="row">
      <div class="container">

          <h1>Skapa Konto</h1>

          @include('layouts.errors')

          <form class="" action="/register" method="post">
              {{ csrf_field() }}

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Namn</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" placeholder="Namn" name="name">
                </div>
              </div>
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
                <label for="password_confirmation" class="col-sm-2 col-form-label">Bekräfta Lösenord</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password_confirmation" placeholder="Välj ett lösenord.." name="password_confirmation">
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
