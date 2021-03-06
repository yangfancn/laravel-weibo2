@foreach(['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
    <div class="flash-message mb-3">
      <p class="alert alert-{{ $msg }} mb-0">
        {{ session()->get($msg) }}
      </p>
    </div>
  @endif
@endforeach
