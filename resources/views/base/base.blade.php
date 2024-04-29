<!---
    The is the layout file for all pages across the website witht he exception of the dashboard area
    This file covers the header and footer section of the website

-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--- set custom title for each of the page-->
     <title>@yield('title')</title>



        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


     <!--End of link custom css files -->


     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-QLIq7Fqhj07dJ/oDKC4RApV5V4PPX0Xr2lryREs2znPm6wOhAMfcJC9uKn+5aWjZ" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-rHK8Yvo0Hq21bHk1hiOPpGWT1H8wvcPb11TPFqEadFk5BdCiA/pz5wr5bx6F7bMd" crossorigin="anonymous">

     <!--- adding swippers--->
     <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    @yield('link')`
    <!--- end of links to the css files  -->



</head>
<body onload="slider()">

    <!----- To display exchange rate--- I used exchange rate api which has expired, the code is in the BaseController-->
    {{-- <div class="display-exchange-rate">
        <ul class="exchange-rate-list">
            @if(isset($exchangeRate['rates']))
                @foreach($exchangeRate['rates'] as $currency => $rate)
                    <li>{{ $currency }}: {{ $rate }}</li>
                @endforeach
            @else
                <li>Exchange rates currently unavailable</li>
            @endif
        </ul>

    </div> --}}




    <div class="toggle-menu" style=" top: 50px; right: 10px; font-size: 1.8rem; ">
        <a href="#" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </a>
    </div>
            <header class="header">

                <nav >

                    <ul>

                             <!-- Toggle button for mobile menu -->

                        <li>
                            <a href="/">
                                <img src="images/e-news logo white.jpeg" alt="E-News Logo" style="width: 100"; height="100">
                            </a>
                        </li>

                        <li>
                            <form action="/search" method="get" class="form">
                                <div class="search-container">
                                    <input type="search" name="search" id="search">
                                    <button type="submit">Search</button>
                                </div>
                            </form>
                        </li>

                        <li><a href="{{ route('category.show', 'nigeria') }}">Nigeria</a></li>
                        <li><a href="{{ route('category.show', 'world') }}">World</a></li>
                        <li><a href="{{ route('category.show', 'politics') }}">Politics</a></li>
                        <li><a href="{{ route('category.show', 'business') }}">Business</a></li>
                        <li><a href="{{ route('category.show', 'health') }}">Health</a></li>
                        <li><a href="{{ route('category.show', 'entertainment') }}">Entertainment</a></li>
                        <li><a href="{{ route('category.show', 'sport') }}">Sport</a></li>
                        <li>
                            <a href="{{ route('category.show', 'music') }}">
                                {{-- <i class="fas fa-music"></i> --}}
                                Music
                            </a>
                        </li>
                        <li>
                            <a href="/discussion">
                                <i class="fas fa-comments"></i>
                                Discussion
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">Account</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{  route('admin.register') }}">Register As An Editor</a></li>
                                <li><a href="{{  route('admin.login') }}">Editor Dashboard</a></li>
                            </ul>
                        </li>




                    </ul>
                </nav>

            </header>


         @yield('hero-content')


            @yield('page-content')


            <footer>
                <div class="subscriber">
                    <img src="images/notifiation.png" alt="Subscriber for E-news">
                    <div class="subscribe-form">
                        <h6>subscribe to our newsletter</h6>
                        <p>Don't miss out on latest update and information</p>
                        <form action="" method="get" class="form">
                            <div class="search-container">
                                <input type="email" name="subscriber-email" id="subscribe-email">
                                <button type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>


            </footer>


                 <div class="footer">
                    <form action="/search" method="get" class="form">
                        <div class="search-container">
                            <input type="search" name="search" id="search">
                            <button type="submit">Search</button>
                        </div>
                    </form>

                    <div class="footer-links">
                        <div class="about-us-footer">
                            <h3>About Us</h3>
                            <p>
                                We're committed to delivering accurate, unbiased reporting on a wide range of topics, from politics to technology to entertainment.
                                 Our team of experienced journalists works tirelessly to bring you the latest stories and perspectives from around the globe.
                                 At ESeential News, we believe in the power of information to shape understanding and drive positive change.
                                 Join us in staying informed, engaged, and empowered."
                            </p>
                            <button>Learn More</button>
                        </div>

                        <div class="quick-links-footer">


                            <div class="link-item">
                                <h5>Nigeria</h5>
                                <ul>
                                    @if(isset($newsPostsFooter) && !$newsPostsFooter->isEmpty())
                                    @foreach($newsPostsFooter->sortByDesc('created_at')->filter(function($post) {
                                        return $post->category == 'Nigeria';
                                    })->take(8) as $post)
                                        <li>
                                            <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                        </li>
                                    @endforeach

                                    @if($newsPostsFooter->filter(function($post) {
                                        return $post->category == 'Nigeria';
                                    })->isEmpty())
                                        <li><p>No posts available for this category yet</p></li>
                                    @endif
                                @else
                                    <li><p>No posts available for this category yet</p></li>
                                @endif
                                </ul>
                            </div>

                            <div class="link-item">
                                <h5>World</h5>
                                <ul>



                                    @if(isset($newsPostsFooter) && !$newsPostsFooter->isEmpty())
                                    @foreach($newsPostsFooter->sortByDesc('created_at')->filter(function($post) {
                                        return $post->category == 'World';
                                    })->take(8) as $post)
                                        <li>
                                            <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                        </li>
                                    @endforeach

                                    @if($newsPostsFooter->filter(function($post) {
                                        return $post->category == 'World';
                                    })->isEmpty())
                                        <li><p>No posts available for this category yet</p></li>
                                    @endif
                                @else
                                    <li><p>No posts available for this category yet</p></li>
                                @endif



                                </ul>

                            </div>

                            <div class="link-item">
                                <h5>Business</h5>
                                <ul>
                                    @if(isset($newsPostsFooter) && !$newsPostsFooter->isEmpty())
                                    @foreach($newsPostsFooter->sortByDesc('created_at')->filter(function($post) {
                                        return $post->category == 'Business';
                                    })->take(8) as $post)
                                        <li>
                                            <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                        </li>
                                    @endforeach

                                    @if($newsPostsFooter->filter(function($post) {
                                        return $post->category == 'Business';
                                    })->isEmpty())
                                        <li><p>No posts available for this category yet</p></li>
                                    @endif
                                @else
                                    <li><p>No posts available for this category yet</p></li>
                                @endif
                                </ul>
                            </div>

                            <div class="link-item">
                                <h5>Technology</h5>
                                <ul>
                                    @if(isset($newsPostsFooter) && !$newsPostsFooter->isEmpty())
                                    @foreach($newsPostsFooter->sortByDesc('created_at')->filter(function($post) {
                                        return $post->category == 'Technology';
                                    })->take(8) as $post)
                                        <li>
                                            <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                        </li>
                                    @endforeach

                                    @if($newsPostsFooter->filter(function($post) {
                                        return $post->category == 'Technology';
                                    })->isEmpty())
                                        <li><p>No posts available for this category yet</p></li>
                                    @endif
                                @else
                                    <li><p>No posts available for this category yet</p></li>
                                @endif
                                </ul>
                            </div>

                            <div class="link-item">
                                <h5>Entertainment</h5>
                                <ul>
                                    @if(isset($newsPostsFooter) && !$newsPostsFooter->isEmpty())
                                    @foreach($newsPostsFooter->sortByDesc('created_at')->filter(function($post) {
                                        return $post->category == 'Entertainment';
                                    })->take(8) as $post)
                                        <li>
                                            <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                        </li>
                                    @endforeach

                                    @if($newsPostsFooter->filter(function($post) {
                                        return $post->category == 'Entertainment';
                                    })->isEmpty())
                                        <li><p>No posts available for this category yet</p></li>
                                    @endif
                                @else
                                    <li><p>No posts available for this category yet</p></li>
                                @endif
                                </ul>
                            </div>

                            <div class="link-item">
                                <h5>Health</h5>
                                <ul>
                                    @if(isset($newsPostsFooter) && !$newsPostsFooter->isEmpty())
                                    @foreach($newsPostsFooter->sortByDesc('created_at')->filter(function($post) {
                                        return $post->category == 'Health';
                                    })->take(8) as $post)
                                        <li>
                                            <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                        </li>
                                    @endforeach

                                    @if($newsPostsFooter->filter(function($post) {
                                        return $post->category == 'Health';
                                    })->isEmpty())
                                        <li><p>No posts available for this category yet</p></li>
                                    @endif
                                @else
                                    <li><p>No posts available for this category yet</p></li>
                                @endif
                                </ul>
                            </div>





                            <div class="link-item">
                                <h5>Follow Us</h5>
                                <ul class="social-icons">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>

                                </ul>
                            </div>


                        </div>
                    </div>
                </div>



                  <!--- implementing automated scroll up--->
                  <button id="scrollToTopBtn" class="scroll-to-top-btn">Scroll to Top</button>

</body>
</html>
