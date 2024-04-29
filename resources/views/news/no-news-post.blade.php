<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Essential News</title>


        <!-- Other CSS files -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Your custom CSS file -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">


     <!--End of link custom css files -->

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-QLIq7Fqhj07dJ/oDKC4RApV5V4PPX0Xr2lryREs2znPm6wOhAMfcJC9uKn+5aWjZ" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-rHK8Yvo0Hq21bHk1hiOPpGWT1H8wvcPb11TPFqEadFk5BdCiA/pz5wr5bx6F7bMd" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    @yield('link')`
</head>
<body>
    <div class="display-exchange-rate">
        <ul class="exchange-rate-list">
            @if(isset($exchangeRate['rates']))
                @foreach($exchangeRate['rates'] as $currency => $rate)
                    <li>{{ $currency }}: {{ $rate }}</li>
                @endforeach
            @else
                <li>Exchange rates currently unavailable</li>
            @endif
        </ul>
    </div>
            <header>
                <nav>
                    <ul>
                        <li>
                            <a href="">
                                <img src="../images/e-direct-logo.png" alt="E-Direct Logo">
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
                            <a href="">
                                <i class="fa-solid fa-microphone"></i>
                                Audio
                            </a>
                        </li>
                        <!---
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">Account</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('single') }}">Admin Area</a></li>
                            </ul>
                        </li>
                    -->

                    </ul>
                </nav>
            </header>


    <main>
        <section>
                <div class="not-found">
                    <div class="notfound-txt">
                        <h3 style="text-transform: none">No posts available for this category at the moment.</h3>
                        <p>Kindly, ensure you have not entered an invalid category.  </p> <br> <br>

                        <strong style="color:darkorange">
                            REDIRECTING TO THE HOMEPAGE In 3 seconds
                        </strong>
                    </div>




                    <div class="aside-container">

                    </div>
                </div>

                <script>
                    // Display an alert message

                    // Redirect to the homepage after a delay
                    setTimeout(function() {
                        window.location.href = "{{ route('index') }}";
                    }, 3000);
                </script>



        </section>

    </main>

    <footer>

        <div class="subscriber">
            <img src="/images/notifiation.png" alt="Subscriber for E-news">
            <div class="subscribe-form">
                <h6>subscribe to our newsletter</h6>
                <p>Don't miss out on latest update and information</p>
                <form action="" method="get" class="form">
                    <div class="search-container">
                        <input type="email" name="subscriber-email" id="subscribe-email">
                        <button type="submit">Search</button>
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













            </div>
        </div>
    </div>
</body>
</html>
