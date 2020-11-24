<div class="list-group-item">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="mr-3 gravatar">
  <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
</div>
