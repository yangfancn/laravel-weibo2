@extends('layouts.default')
@section('title', $user->name . '个人主页')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <section class="user_info">
        @include('shared._user_info')
      </section>
    </div>
  </div>
@endsection
