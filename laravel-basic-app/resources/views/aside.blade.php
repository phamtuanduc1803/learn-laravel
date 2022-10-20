<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
<aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
    <h1 id="colorlib-logo">
        @if(Auth::check())
            <a href={{ route('user.profile', ['id'=> Auth::user()->id]) }}>{{ Auth::user()->first_name }}<span>.</span></a>
        @else
            <a href="{{ route('home') }}">blog<span>.</span></a>
        @endif
    </h1>
    <nav id="colorlib-main-menu" role="navigation">
        <ul>
            @if (Route::has('login'))
                    @auth
                        <li class=><a href={{ route('home') }}>Home</a></li>
                        <li class=><a href="{{ route('user.profile', ['id' => Auth::user()->id ]) }}">My Blog</a></li>
                        <li class=><a href={{ route('post.create') }}>Post</a></li>
                        <li class="nav-item">
                            <a class="" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                    @endauth
                </div>
            @endif

        </ul>
    </nav>

    <div class="colorlib-footer">
        <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        <ul>
            <li><a href="#"><i class="icon-facebook"></i></a></li>
            <li><a href="#"><i class="icon-twitter"></i></a></li>
            <li><a href="#"><i class="icon-instagram"></i></a></li>
            <li><a href="#"><i class="icon-linkedin"></i></a></li>
        </ul>
    </div>
</aside> <!-- END COLORLIB-ASIDE -->
