@extends('layout')
@section('body')
    <div class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{asset('images/bg_4.jpg')}});" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="js-fullheight d-flex justify-content-center align-items-center">
            <div class="col-md-8 text text-center">
                <div class="img mb-4" style="background-image: url({{asset('storage'.$user->image_path)}});"></div>
                <div class="desc">
                    <h1 class="mb-4">@if (Auth::user()->id == $user->id)
                            <a href="{{route('user.edit')}}">{{ $user->first_name }} {{ $user->last_name }}</a>
                        @else
                            {{ $user->first_name }} {{ $user->last_name }}
                        @endif
                    </h1>
                    <ul class="ftco-social mt-3">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-4">
                    <h2 class="h4 font-weight-bold">Information</h2>
                </div>
                <div class="w-100"></div>
                <div class="col-md-4">
                    <p><span>Address:</span></p>
                </div>
                <div class="col-md-4">
                    <p><span>Phone:</span> <a href=""></a></p>
                </div>
                <div class="col-md-4">
                    <p><span>Email:</span> <a href="">{{ $user->email }}</a></p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                <h2 class="h4 font-weight-bold">Posts List</h2>
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
                                       style="background-image: url({{asset('storage'.$user->image_path)}});"></a>
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
