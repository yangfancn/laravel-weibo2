<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Weibo App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
          <li class="nav-item">
            <a href="#" class="nav-link">用户列表</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle user-photo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{Auth::user()->gravatar()}}" alt="{{ Auth::user()->name }}">
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('users.show', [Auth::user()]) }}" class="dropdown-item">个人中心</a>
              <a href="#" class="dropdown-item">编辑资料</a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <button class="btn btn-block btn-danger">退出</button>
              </form>
              </a>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">登录</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
