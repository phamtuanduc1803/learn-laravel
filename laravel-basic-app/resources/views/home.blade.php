@extends('layout')
@section('body')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="sidebar-box">
                    <form action="{{route('search')}}" class="search-form" method="POST">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <span class="icon icon-search"></span>
                            <input type="text" class="form-control" placeholder="Type a keyword and hit enter" name="search_key">
                        </div>
                    </form>
                </div>

            @foreach ($posts as $post)
                    <div class="col-md-4">
                        <div class="blog-entry ftco-animate">
                            <a href='{{ route('post.show', ['post' => $post->id]) }}' class="img img-2"
                                style="background-image: url({{ asset('storage'.$post->image_path) }});"></a>
                            <div class="text text-2 pt-2 mt-3">
                                <span class="category mb-3 d-block"><a
                                        href="{{ route('category.show', ['category' => $post->category_id]) }}">{{ $post->category->name }}</a></span>
                                <h3 class="mb-4" style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 25px;
                            -webkit-line-clamp: 2;
                            height: 50px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;"><a
                                        href='{{ route('post.show', ['post' => $post->id]) }}'>{{ $post->title }}</a></h3>
                                <div class="author mb-4 d-flex align-items-center">
                                    <a href="{{ route('user.profile', ['id'=> $post->user_id]) }}" class="img"
                                        style="background-image: url({{asset('storage'.$post->user->image_path)}});"></a>
                                    <div class="ml-3 info">
                                        <span>Written by</span>
                                        <h3><a href="{{ route('user.profile', ['id'=> $post->user_id]) }}">{{ $post->user->first_name }}
                                                {{ $post->user->last_name }}</a><br><span>{{ $post->updated_at }}</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="meta-wrap align-items-center">
                                    <div class="half order-md-last">
                                        <p class="meta">
                                            <span><i class="icon-heart"></i>{{ $post->num_like }}</span>
                                            <span><i class="icon-eye"></i>{{ $post->num_view }}</span>
                                            <span><i class="icon-comment"></i>{{ $post->num_comment }}</span>
                                        </p>
                                    </div>
                                    <div class="half">
                                        <p><a href="{{ route('post.show', ['post' => $post->id]) }}"
                                                class="btn py-2">Continue Reading <span
                                                    class="ion-ios-arrow-forward"></span></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->links('vendor.pagination.default') }}
        </div>
    </section>
@endsection
