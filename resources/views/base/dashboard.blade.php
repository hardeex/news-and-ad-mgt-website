
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

<style>
    nav ul li a{
        color: black
    }

    </style>

</head>
<body onload="slider()">






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
                                <img src="images/e-news logo white.jpeg" alt="E-News Logo">
                            </a>
                        </li>


                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('user.posts') }}">My Posts</a></li>
                        <li><a href="{{ route('admin.news.create') }}">Submit a Post</a></li>
                        <li><a href="{{ route('short_videos.create') }}">Upload News Video</a></li>
                        <li><a href="{{ route('short_videos.myvideos') }}">Manage Video</a></li>
                        <li><a href="/discussion">Discussion</a></li>
                        <li><a href="{{ route('profile.edit') }}">Settings</a></li>






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






                  <!--- implementing automated scroll up--->
                  <button id="scrollToTopBtn" class="scroll-to-top-btn">Scroll to Top</button>

</body>
</html>
