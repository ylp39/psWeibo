<li class="media mt-4 mb-4">
  <a href="{{ route('users.show', $user->id) }}">
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar">
  </a>
  <div class="media-body">
    <h5 class="mt-0 mb-1">
      {{ $user->name }}
      <small>/ {{ $status->created_at->diffForHumans() }}</small>
    </h5>
    <a href="{{ route('statuses.show',$status->id) }}">{{ $status->content }}</a>
  </div>

  @can('destroy', $status)
    <form onsubmit="return confirm('确定要删除吗?');" method="POST" action="{{ route('statuses.destroy', $status->id) }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type="submit" class="btn btn-sm btn-danger">删除</button>
    </form>
  @endcan
</li>
