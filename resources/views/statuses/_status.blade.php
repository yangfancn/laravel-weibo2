<li class="media mt-4 mb-4">
  <a href="{{ route('users.show', $user->id) }}" title="{{ $user->name }}">
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar">
  </a>
  <div class="media-body">
    <h5 class="mt-0 mb-1">{{ $user->name }}<small> . {{ $status->created_at->diffForHumans() }}</small></h5>
    <p class="mb-0">{{ $status->content }}</p>
  </div>
</li>
