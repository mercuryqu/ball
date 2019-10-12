@extends('layouts.wap.app')

@section('title', $app->name . '的所有评论')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/comments-index.css') }}">
@endsection

@section('content')
    <!-- title -->
    <div class="headline-title">
        <span style="font-weight: 800">{{ $app->name or '' }}的所有评论</span>
    </div>

    <div class="synopsis_pl_sp ">
        <h5>评论</h5>
    </div>
    <div class="conten">
        @if($app->comments->count() > 0)
            @foreach($app->comments as $comment)
            <div class="synopsis_pol clearfix">
                    <div class="synopsis_pol_lo">
                        <div class="opsi clearfix">
                            <span class="opsi_left">{{ $comment->member->name or '' }}</span>
                            <span class="opsi_right">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <ul class="synopsis_pol_xx clearfix ">
                            {!! make_star($comment->star) !!}
                        </ul>
                        <p>{{ $comment->body or '' }}</p>
                    </div>
                    @if($comment->is_reply == 1 && $comment->reply && $comment->reply->user && $comment->reply->user->name)
                        <div class="synopsis_pol_lo clearfix opsitop">
                            <div class="opsi clearfix ">
                                <span class="opsi_left">{{ $comment->reply->user->name or '' }}</span>
                                <span class="opsi_right">{{ $comment->reply->user->created_at->diffForHumans() }}</span>
                            </div>

                            <p>{{ $comment->reply->body or '' }}</p>
                        </div>
                    @endif
            </div>
            @endforeach
        @endif

        @include('layouts.wap.common._back')
    </div>
@endsection