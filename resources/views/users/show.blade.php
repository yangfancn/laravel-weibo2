@extends('layouts.default')
@section('title', $user->name . '个人主页')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <section class="user_info">
        @include('shared._user_info')
      </section>
      <section class="status">
        @if (count($statuses) > 0)
          <ul class="list-unstyled">
            @foreach ($statuses as $status)
                @include('statuses._status')
            @endforeach
          </ul>
          <div class="mt-5">
            {!! $statuses->render() !!}
          </div>
        @else
          <p class="alert alert-warning">没有数据！</p>
        @endif
      </section>
    </div>
  </div>
@endsection
