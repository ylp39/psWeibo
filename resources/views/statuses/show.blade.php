@extends('layouts.default')
@section('title','微博')

@section('content')
  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            作者:{{ $status->user->name }}
          </div>
          <hr>
          <div class="media">
            <div align="center">
              <a href="{{ route('users.show', $status->user->id) }}">
                <img class="img-thumbnail img-fluid" src="{{ $status->user->gravatar('300') }}"
                     width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card ">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $status->id }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $status->created_at->diffForHumans() }}
            ⋅
            <i class="far fa-comment"></i>
            {{ $status->id }}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $status->content !!}
          </div>

{{--          <div class="operate">--}}
{{--            <hr>--}}
{{--            <a href="#" class="btn btn-outline-secondary btn-sm" role="button">--}}
{{--              <i class="far fa-edit"></i> 编辑--}}
{{--            </a>--}}
{{--            <a href="#" class="btn btn-outline-secondary btn-sm" role="button">--}}
{{--              <i class="far fa-trash-alt"></i> 删除--}}
{{--            </a>--}}
{{--          </div>--}}
          
        </div>
      </div>

      {{-- 用户回复列表 --}}
      <div class="card topic-reply mt-4">
        <div class="card-body">
          @include('statuses._reply_box', ['status' => $status])
          @include('statuses._reply_list', ['replies' => $status->replies()->with('user')->get()])
        </div>
      </div>

    </div>
  </div>
@stop
