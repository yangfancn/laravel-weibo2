@extends('layouts.default')
@section('title', '用户注册')

@section('content')
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header">
        <h5>注册</h5>
      </div>
      <div class="card-body">
        @include('shared._error')
        <form action="{{ route('users.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">名称：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="email">Email：</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="password-confirmation">确认密码：</label>
            <input type="password" name="password-confirmation" class="form-control" value="">
          </div>
          <button type="submit" class="btn btn-primary">注册</button>
        </form>
      </div>
    </div>
  </div>
@endsection
