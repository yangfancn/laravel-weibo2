<div class="list-group-item">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="mr-3 gravatar">
  <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
  @can('destory', $user)
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="float-right">
      @csrf
      {{ method_field('DELETE') }}

      <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
    </form>
  @endcan
</div>
