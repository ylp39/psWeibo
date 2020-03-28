@extends('layouts.default')
@section('title', $title)

@section('content')
  <div class="offset-md-2 col-md-8">
    <h2 class="mb-4 text-center">{{ $title }}</h2>

    <div class="list-group list-group-flush">
      @if ($statuses->count() > 0)
        @foreach ($statuses as $status)
        <div class="list-group-item">
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
        </div>

      @endforeach
      @else
        <p>没有数据！</p>
      @endif
    </div>

    <div class="mt-3">
      {!! $statuses->render() !!}
    </div>
  </div>
@stop
