@extends('layout')
@section('body')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <h2 class="mb-3 font-weight-bold">{{ $post->title }}</h2>
                <div style="word-break: break-word">@php
                        echo str_replace('<img', '<img class="img-fluid"', $post->body);
                    @endphp</div>
                @auth
                    @if ($post->user_id == Auth::user()->id)
                        <div class="row">
                            <a href="{{ route('post.edit', ['post'=>$post->id]) }}" class="btn"><span class="icon-edit"></span></a>
                            <form action="{{ route('post.destroy', ['post'=>$post->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn" type="submit"><span class="icon-delete"></span></button>
                            </form>
                        </div>
                    @endif
                @endauth
                <div class="pt-5 mt-5">
                    <div class="row">
                        <h4 class="col-7">{{ $post->num_comment }} Comments</h4>
                        <h4 class='col-1'>{{ $post->num_like }}</h4>
                        @auth
                            @if ($like == null)
                                <a href="{{ route('like.store', ['post' => $post->id]) }}" class="btn btn-danger"><span class="icon-heart"></span></a>
                            @else
                                @if ($like->like_status == 0)
                                    <a href="{{ route('like.update', ['like' => $like->id]) }}" class="btn btn-danger"><span class="icon-heart"></span></a>
                                @else
                                    <a href="{{ route('like.update', ['like' => $like->id]) }}" class="btn btn-success"><span class="icon-heart"></span></a>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-danger"><span class="icon-heart"></span></a>
                        @endauth
                    </div>
                    <ul class="comment-list">
                        @foreach ($comments as $comment)
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{asset('storage'.$comment->user->image_path)}}" alt="Image placeholder">
                                </div>
                                <div class="comment-body" style="word-break: break-all" >
                                    <h3>{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</h3>
                                    <div class="meta">{{ $comment->created_at }}</div>
                                    <p>{{ $comment->body }}</p>
                                    <p><a href="#" class="reply">Reply</a></p>
                                </div>
                             </li>
                        @endforeach
                    </ul>
                </div>
                <div class="comment-form-wrap pt-5">
                    <form action="{{ route('comment.store') }}" class="p-3 p-md-5 bg-light" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="message">Comment</label>
                            <textarea name="comment" id="message" cols="20" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input name="post_id" value="{{ $post->id }}" hidden='true'>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box ftco-animate">
                    <h3 class="sidebar-heading">Popular Articles</h3>
                    @foreach($populars as $popular)
                        <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url({{ asset('storage'.$popular->image_path) }});"></a>
                        <div class="text">
                            <h3 class="heading" style="word-break: break-all"><a href="{{ route('post.show', ['post' => $popular->id]) }}">{{$popular->title}}</a></h3>
                            <div class="meta">
                                <div><a href="{{ route('user.profile', ['id' => $popular->user_id]) }}"><span class="icon-person"></span>{{$popular->user->first_name}} {{ $popular->user->last_name }}</a></div>
                                <div><a href="{{ route('post.show', ['post' => $popular->id]) }}"><span class="icon-chat"></span>{{$popular->num_comment}}</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{ $populars->links('vendor.pagination.default') }}
                </div>
            </div>
</section>
@endsection
