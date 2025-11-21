<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- if(isset($bk_title)){
        <title>{{ $bk_title }}</title>
    }else{
        <title>{{ config('app.name', 'Gradestar') }}</title>
    } --}}
    
    <title> @yield('title') </title>
    <link href="@yield('canonical_url')" rel="canonical">
    <meta name="title" content="@yield('meta_title')">
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('keywords')">

    <meta property="og:title" content="@yield('meta_title')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('canonical_url')">
    <meta property="og:site_name" content="GradeStar Solutions">
    <meta property="og:image" content="@yield('image_url')">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title')">
    <meta name="twitter:description" content="@yield('meta_description')">
    <meta name="twitter:image" content="@yield('image_url')">


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    @vite([

        'resources/js/app.js',
        'resources/css/site.css',
        // 'resources/css/product.css',

        ])

    
    
</head>
<body>
    <div class="wrapper" >
        <div class="navigation">
            <div class="logo">
                <div class="logo-image">
                    <a  href="{{ url('/') }}">
                        <div class="logo_sizer" >
                            <img src="{{asset('assets/images/logo.jpeg')}}" width="100%" alt="Logo">
                        </div>
                    </a>
                </div>
                <div class="site-title">
                    {{-- <a class="link_tag" href="{{ url('/') }}"> --}}
                        <p>GRADESTAR</p>
                    {{-- </a> --}}
                </div>
            </div>

            {{-- <div class="site-title">
                <p>GRADESTAR</p>
            </div> --}}

            <div class="search_div" >
                {{-- {{route('search')}} --}}
                <form action="{{route('Booksearch')}}" method="get">
                    <div class="search_fields">
                        <div>
                            <input type="text" name="p" id="search" required placeholder="Search for books" class="search_input" > 
                        </div>
                        <div>
                            <input type="submit" value="Search" class="search_button">
                        </div>
                        
                        
                    </div>
                    {{-- <input type="text" name="p" id="search" required placeholder="Search for books" class="search_input" > --}}
                    {{-- <a href="search/"> --}}
                    {{-- <input type="submit" value="search" class="search_button"> --}}
                    {{-- </a> --}}
                </form>
                
            </div>

            {{-- <div>
                <div class="site-title">
                    <p>GRADESTAR</p>
                </div>
                
            </div> --}}
            

            <div class="nav-links">
                <i class="fa-sharp fa-light fa-cart-shopping fa-sm"></i>
                <ul>
                    <!-- Nav Links !-->
                    <li>
                        <a href="{{ route('shop') }}" >
                            <b>Test banks</b>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart') }}" >
                            <b>Cart</b>
                        </a>
                    </li>
                    
                    <li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        {{-- {{ __('Login') }} --}}
                                        <b>Account</b>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ Auth::user()->name }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest

                    </li>

                    

                    
                    <!-- Authentication Links -->
                    {{-- @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                          @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    @endguest --}}
                </ul>
            </div>
        </div>

        {{-- Mobile device search --------------------------}}
        <div class="search_div search_div_mobile" >
            <form action="{{route('Booksearch')}}" method="get">
                <div class="search_fields">
                    <div class="search_input_field_div">
                        <input type="text" name="p" id="search" required placeholder="Search for books" class="search_input search_input_mobile" > 
                    </div>
                    <div>
                        <input type="submit" value="Search" class="search_button">
                    </div>
                    
                    
                </div>
                {{-- <input type="text" name="p" id="search" required placeholder="Search for books" class="search_input" > --}}
                {{-- <a href="search/"> --}}
                {{-- <input type="submit" value="search" class="search_button"> --}}
                {{-- </a> --}}
            </form>
            
        </div>

    <main>
        @yield('content')
    </main>

    </div>

    <footer>
        <div class="footer">
            <div class="footer-links foot">
                <div class="footer-headings">Useful Links</div>
                <ul>
                    <li><a class="link_tag" href={{route('about')}}> About us</a></li>
                    {{-- <li><a href=#>Contact us</a></li> --}}
                </ul>
            </div>
            {{-- {{dd(Auth::user()->priveledge)}} --}}
            
            @if( Auth::user()!==null && Auth::user()->priveledge > 1 )
                <div class="adminsection foot">
                    <div class="footer-headings">Admin Section</div>
                    <ul>
                        <li><a class="link_tag" href={{route('product_create')}}>Book store</a></li>
                        @if(Auth::user()->priveledge > 2 )
                            <li><a class="link_tag" href={{route('billing')}}>Billing</a></li>
                            <li><a class="link_tag" href={{route('transactions')}}>Transactions</a></li>
                            {{-- <li><a class="link_tag" href={{route('users')}}>Users</a></li> --}}
                        @endif
                    </ul>
                </div>
            @endif

            <div class="contact foot">
                <div class="footer-headings">Contact info</div>
                Gradestar Solutions<br>
                3931 Pine Garden Lane<br>
                Sedona<br>
                Phone: 770-669-3486<br>
                Email: sales@gradestarsolutions.com<br>
            </div>
        </div>
        <div class="copyright">
            Gradestar &copy {{date('Y')}}
        </div>
    </footer>

</body>
</html>