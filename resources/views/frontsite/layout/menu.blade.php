<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="{{route('frontsite.home')}}"><img src="{{asset('img/core-img/logo.png')}}" alt=""></a>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>

            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{route('frontsite.home')}}">Home</a></li>
            <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="{{route('frontsite.shop',1)}}">Shop</a></li>
            <li class="{{ Request::is('cart') ? 'active' : '' }}"><a href="{{route('frontsite.cart')}}">Cart</a></li>
            <li class="{{ Request::is('checkout') ? 'active' : '' }}"><a href="{{route('checkout')}}">Checkout</a></li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="#" class="btn amado-btn mb-15">%Discount%</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div>

    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{route('frontsite.cart')}}" class="cart-nav"><img src="{{asset('img/core-img/cart.png')}}" alt="">
            @Auth
                Cart
                <span class="cart-quantity" id="cart-counter">(
                {{App\Models\Cart::all()->where('user_id', auth()->user()->id)->count()}}
                             )</span>
            @endauth
            @guest
                Cart
                <span class="cart-quantity" id="cart-counter">(0)</span>
            @endguest
        </a>

{{--        <a href="#" class="fav-nav"><img src="{{asset('img/core-img/favorites.png')}}" alt=""> Favourite</a>--}}
{{--        <form action="{{route('frontsite.search')}}" method="post">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <input type="text" class="form-control" placeholder='Search Keyword' name="search"--}}
{{--                           onfocus="this.placeholder = ''"--}}
{{--                           onblur="this.placeholder = 'Search Keyword'">--}}
{{--                    <div class="input-group-append">--}}
{{--                        <button class="btns" type="button"><i class="ti-search"></i></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"--}}
{{--                    type="submit" >Search</button>--}}
{{--        </form>--}}
        <form action="{{route('frontsite.search')}}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <img style="margin-right: 5px" src="{{asset('img/core-img/search.png')}}">
                <input type="text" class="form-control" name="search"
                       placeholder="Search..."> <span class="input-group-btn">
{{--            <button type="submit" class="btn btn-default">--}}
{{--                <span class="glyphicon glyphicon-search"></span>--}}
{{--            </button>--}}
        </span>
            </div>
        </form>
{{--        <button style="padding: 10px;background-color: white;border: white;" class="search-nav"><img src="{{asset('img/core-img/search.png')}}" alt=""> Search</button>--}}
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>
</header>
