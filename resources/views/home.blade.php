<!---
    Developer - Jaiu Adewale Yusuf
    Css FIle - Main.css
    JavaScript FIle -- main.js
    Project GIthub Link - https://github.com/hardeex/e-news-podcast-movies
    Date of commencement - February 13th, 2024
    Date of completiion -- 15th of April 2024

    PS: In-line JS FIles are used for code that requires blade or php to run. sliding post images are sample of this file

--->





<!--- adding the base layout -->
@extends('base.base')
<!-- adding the page title-->
@section('title', 'E-News')
<!---Adding the styling and js links-->
@section('link')
{{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
@endsection

@section('page-content')
    <section>
        <div class="news-header-container">
            <div class="update-and-news-slider">
                <div class="news-update-slider">
                    @if ($newsPosts->isNotEmpty())
                    <div id="slider-container">
                        @foreach ($newsPosts as $post)
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="news update" id="slider-img" style="width: 100%; height: 400px;">
                                @break {{-- Break after the first non-empty image --}}
                            @endif
                        @endforeach
                    </div>
                @endif


                </div>

                <!---- Handling the sliding of the images--->
                <script>
                    var storeSliderImages = [   // store the images in the variable
                        @foreach($newsPosts->sortByDesc('created_at') as $post)
                            "{{ asset('storage/' . $post->image) }}",   // The images are stored in the folder Storage/app/Public/news_images. I handled this in NewsPostController using the store method
                        @endforeach
                    ];

                    var len = storeSliderImages.length;
                    var i = 0;

                    function slider() {
                        var slideImage = document.getElementById("slider-img");

                        if (i > len - 1) {
                            i = 0;
                        }

                        slideImage.src = storeSliderImages[i];
                        i++;
                        setTimeout(slider, 5000); // slide each post image after 5 seconds
                    }

                    // Start the slider
                    slider(); // calling the slider function to commence the sliding of the post images
                </script>



                <!---- the nav menu items --- Handled using the NewsController under showPost method -->
                <div class="news-category-container">
                    <div class="news-update">
                        <a href="{{ route('category.show', 'health') }}" class="new-cat">Health</a>
                        <a href="{{ route('category.show', 'lifestyle') }}" class="new-cat">Lifestyle</a>
                        <a href="{{ route('category.show', 'politics') }}" class="new-cat"> Politics </a>
                        <a href="{{ route('category.show', 'local') }}" class="new-cat">Local</a>
                        <a href="{{ route('category.show', 'international') }}" class="new-cat">International</a>
                        <a href="{{ route('category.show', 'hotels') }}" class="new-cat">Hotels</a>
                        <a href="{{ route('category.show', 'business') }}" class="new-cat">Business</a>
                        <a href="{{ route('category.show', 'tedchnology') }}" class="new-cat">Technology</a>
                        <a href="{{ route('category.show', 'education & learning') }}" class="new-cat">Education & Learning</a>
                    </div>
                </div>

            </div>


            <!-- start of the headline section-->
            <div class="news-headline-container">
                <h3>Headline</h3>


                <!--- show the news headline-->

                <div class="news-headline">
                    @foreach($newsPosts->sortByDesc('created_at') as $post) <!---The variable newsPost can be found in the NewsPostcontroller passed to the Miancontroller------>
                    @if($post->is_headline)
                        @if($post->image)
                        <a href="{{ route('post.show', $post->id) }}"> <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image"> </a>  <!---Checkout the web.php for the post.show route-->
                        @endif
                        <a href="{{ route('post.show', $post->id) }}"> <h2 style="text-transform: capitalize; font-size: 1.4rem; color: black">{{ $post->title }}</h2></a>
                        <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 60) !!}</p> <!--Delete html tags in user post and show 60 words as an excerpt---->
                    @endif
                @endforeach

              </div>

              <!---- End of showing headline post-->


                </div>


            <!-- end of the news-container-headline-->
        </div>

    </section>
    <section>
        <div class="gist-section">
            <div class="local-gist">
                <h3>Hot Local Gists</h3>
                @php
                    $localPostsExist = false;
                @endphp

                @foreach($newsPosts->sortByDesc('created_at') as $post)
                    @if($post->category == 'Local')
                        <div class="news-content">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                            <div class="content">
                                <p style="text-transform: capitalize; font-size: 1.1rem"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 20) !!}</p>
                            </div>
                        </div>
                        @php
                            $localPostsExist = true;
                        @endphp
                    @endif
                @endforeach

                @if(!$localPostsExist)
                    <p>No posts available for this category yet</p>
                @endif
            </div>

            <div class="international-gist">
                <h3>Hot International Gists</h3>
                @php
                    $internationalPostsExist = false;
                @endphp

                @foreach($newsPosts->sortByDesc('created_at') as $post)
                    @if($post->category == 'International')
                        <div class="news-content">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                            <div class="content">
                                <p style="text-transform: capitalize; font-size: 1.4rem"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                                <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 20) !!}</p>
                            </div>
                        </div>
                        @php
                            $internationalPostsExist = true;
                        @endphp
                    @endif
                @endforeach

                @if(!$internationalPostsExist)
                    <p>No posts available for this category yet</p>
                @endif
            </div>
        </div>
    </section>

   <section>
     <!---- ==== TEXT< VIDEO AND AD ECTION ===----->
     <div class="txt-vid-ad-section">
        <div class="txt-news">

            <div class="international-gist">
                <h3>Topics</h3>
                @foreach($newsPosts->sortByDesc('created_at')->take(30) as $post)
                    <p><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></p>
                @endforeach



            </div>
        </div>
        <div class="live-video">
            <button disabled><i class="fas fa-play"></i> Live TV</button>

            @if ($youtubeVideos->isNotEmpty())
            {{-- Sort the $youtubeVideos collection by created_at attribute in descending order --}}
            @php
                $sortedVideos = $youtubeVideos->sortByDesc('created_at');
            @endphp

            {{-- Iterate over the sorted videos --}}
            @foreach($sortedVideos as $youtubeVideo)
                @php
                    // Extract video ID from the YouTube link
                    $videoId = getYoutubeVideoId($youtubeVideo->video_link);

                    // Construct the embeddable link
                    $embeddableLink = "https://www.youtube.com/embed/{$videoId}";
                @endphp
                <div class="video-container">
                    <iframe width="100%" height="400px" src="{{ $embeddableLink }}" frameborder="0" allowfullscreen></iframe>
                </div>
            @endforeach
        @endif


        <?php
        function getYoutubeVideoId($url) {
            // Extract video ID from YouTube URL
            $parsedUrl = parse_url($url);
            if (isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $queryParams);
                if (isset($queryParams['v'])) {
                    return $queryParams['v'];
                }
            }
            return null;
        }
        ?>


            <br><br><br>

          @if ($liveVideos->isNotEmpty())
              @foreach($liveVideos->sortByDesc('created_at') as $video)
                <div class="video-container">
                    <video controls>
                        <source src="{{ asset('storage/' . $video->video_upload) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                @endforeach
                @else
                    <p> There is no Live Event at the moment </p>
          @endif

    @if ($liveVideos->isEmpty() && $youtubeVideos->isEmpty())
        {{-- <p>No live event videos available at the moment.</p> --}}
    @endif


            <p style="font-weight: 600">
                @foreach($liveDesc->sortByDesc('created_at') as $desc)
                @if($desc->desc)
                    <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($desc->desc), 60) !!}</p>
                @endif
            @endforeach


            </p>
        </div>

        <div class="news-ad">
            <div class="news-ad">
                @if($verticalAds->isNotEmpty())
                @foreach($verticalAds->sortByDesc('created_at') as $ad)
                    <img src="{{ asset('storage/' . $ad->vertical_ad) }}" alt="Ad">
                @endforeach
            @else
                {{-- <p>No vertical ads found.</p> --}}
            @endif

            </div>

        </div>




    </div>
   </section>

   <section>
     <!--- TOP TOPIC NEWS CATEGORIES SECTION ==== -->
     <div class="e-news-topics">
        <h3>Top Topics</h3>
        <div class="top-topics-container">
            @foreach($newsPosts->sortByDesc('created_at') as $post)
                @if($post->top_topic)
                <div class="top-topic">
                    <a href="{{ route('post.show', $post->id) }}" class="top-topic-link">
                        @if($post->image)
                        <div class="top-topic-image">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                        </div>
                        @endif
                        <div class="top-topic-content">
                            <h2 class="top-topic-title">{{ $post->title }}</h2>
                            <p class="top-topic-excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 80) !!}</p>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </div>

   </section>


   <div class="ad-horizontal-views">
        @if($horizontalAds->isNotEmpty())
        @foreach($horizontalAds->sortByDesc('created_at') as $ad)
            <img src="{{ asset('storage/' . $ad->horizontal_ad) }}" alt="Ad">
        @endforeach
    @else
        {{-- <p>No horizontal ad at the moment.</p> --}}
    @endif

   </div>

   <section>
    <div class="top-news-category" >
        <h3>Top News Category</h3>
        <form action="/search" method="get" class="form">
            <div class="search-container">
                <input type="search" name="search" id="search">
                <button type="submit">Search</button>
            </div>
        </form>

        <div class="cat-item-container" style="margin-top: 50px">
            <div class="cat-item">
                <i class="fas fa-building"></i>
                <a href="{{ route('category.show', 'politics') }}">Politics</a>
            </div>

            <div class="cat-item">
                <i class="fas fa-paint-brush"></i>
                <a href="{{ route('category.show', 'Arts & Entertainment') }}"> Art & Entertainment </a>
                <p></p>
            </div>

            <div class="cat-item">
                <i class="fas fa-briefcase"></i>
                <a href="{{ route('category.show', 'business') }}"> Business </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-comments"></i>
                <a href="{{ route('category.show', 'communication') }}"> Communication </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'automobiles') }}"> Automobiles </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'agriculture&farming') }}">Agriculture & Farming </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'hotels') }}"> Hotels </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'government') }}"> Government </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Health & Medicine') }}"> Health & Medicine </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Hotel & Estate') }}">Hotel & Estate </a>
                <p>  </p>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'IT & Computers') }}"> IT & Computers </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Legal Services') }}"> Legal Services </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', ' Merchants') }}">  Merchants </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Business Service') }}"> Business Service </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Engineering') }}"> Engineering </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Events Conference') }}"> Events Conference </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Energy & Utilities') }}"> Energy & Utilities </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Education & Learning') }}"> Education & Learning </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Car Dealer') }}"> Car Dealer </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Artisans - General Care') }}"> Artisans - General Care </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Security & Emergency') }}"> Security & Emergency </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Pet Supply') }}">Pet Supply </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Schools') }}"> Schools </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Sports') }}"> Sports </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', ' Online Influencers') }}"> Online Influencers </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Personal Care') }}"> Personal Care </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Tourism & Hospitality') }}"> Tourism & Hospitality </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Fashion & Clothing ') }}"> Fashion & Clothing  </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Food & Restaurant') }}"> Food & Restaurant </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Companies ') }}"> Companies  </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Phone/Laptop') }}"> Phone/Laptop </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Religion & Spirituality') }}"> Religion & Spirituality </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Shopping') }}">Shopping </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Transportation') }}">Transportation </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Non-Profit Organization') }}"> Non-Profit Organization </a>
            </div>

            <div class="cat-item">
                <i class="fas fa-car"></i>
                <a href="{{ route('category.show', 'Online Courses') }}"> Online Courses </a>
            </div>

        </div>
        <!--- end of cat-item-category-->

       </div>
   </section>

   <div class="entertainment-container">
    <div class="entertainment-header">
        <p>Entertainment</p>
    </div>

    <section>
        <div class="entertainment-news">
            <div class="get-entertainment-update">
                <div class="featured-news">
                    @php
                    $isEntertainment = false;
                @endphp

                @foreach($newsPosts->sortByDesc('created_at')->take(5) as $post)
                    @if($post->category == 'Entertainment')

                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image" style="width: 100%; height: 370px">
                            @endif
                            <h2><a href="{{ route('post.show', $post->id) }}" class="featured-news-item">{{ $post->title }}</a></h2>

                            <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 50) !!}</p>
                            @php
                                $isEntertainment = true;
                            @endphp
                        </a>
                    @endif
                @endforeach




                    <button type="submit"> <a href="{{ route('category.show', 'entertainment') }}" style="color:white;">See More </a> </button>
                </div>

                <div class="more-news">

        <div class="featured-news-item">

        </div>


                   <div class="more-news-item">
                        @foreach($newsPosts->sortByDesc('created_at') as $post)
                        @if($post->category == 'Music' && $post->is_headline)

                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image" >
                                @endif
                                <h2><a href="{{ route('post.show', $post->id) }}" >{{ $post->title }}</a></h2>

                                <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 30) !!}</p>

                        @endif
                    @endforeach
                   </div>









                </div>
            </div>
            <div class="music-news">
                <h3>Music News</h3>

                <div class="music-news-item">
                    @foreach($newsPosts->sortByDesc('created_at')->take(20) as $post)
                    @if($post->category == 'Music')
                    <div class="music-news-content">
                        <div class="music-news-info">
                            @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image" style="margin-right: 15px">
                            @endif
                            <div class="music-news-desc">
                                <h4><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h4>
                                <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 30) !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>


            </div>
        </div>

    </section>
   </div>

   <!--
   <div class="recent-movie-container">
        <div class="movie-title">
            <p style="font-size: 2rem">Movie Title</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>
        <div class="movie-details">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi natus nulla laborum error itaque cupiditate qui dolorum sequi quam architecto neque ad dolorem, placeat, pariatur quod voluptates. Voluptas, optio magnam.</p>
            <button type="submit">See Movies</button>
        </div>
   </div>
---->
<section>
    <h2>MUSIC FEATURED NEWS</h2>
    <div class="display-music">
        @foreach($newsPosts->sortByDesc('created_at') as $post)
            @if($post->category == 'Music')
                <div class="music-item" style="padding: 20px">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                    @endif
                    <div class="music-news-desc" style="max-width: 170px;">
                        <h4><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h4>

                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>



<!--
   <div class="display-music">
        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>

        <div class="music-item">
            <img src="news/music-cover.jpeg" alt="Music Cover Image">
            <a href="">
                    <div>
                    <h5>Music Title</h5>
                    <p>Singer Name</p>
                </div>
            </a>
        </div>
   </div>
   --->
   <section>
        <button type="submit" style="padding: 10px">See More Music News</button>
   </section>

   <div class="pride-of-nigeria">
    <h2>PRIDE OF NIGERIA</h2>
    <i class="fas fa-star">  Award  </i> <i class="fas fa-star">  </i>
    <section>

        <div class="show-pride-items">
            @foreach($newsPosts->sortByDesc('created_at') as $post)
                @if($post->category == 'Pride of Nigeria')
                    <div class="pride-item">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                        @endif
                        <div class="pride-txt">
                            <h4><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h4>
                            <p class="pride-excerpt">
                                {!! Illuminate\Support\Str::words(strip_tags($post->content), 50) !!}
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach

            @if($newsPosts->where('category', 'Pride of Nigeria')->isEmpty())
                <p>No post available for this category yet</p>
            @endif
        </div>

     <button type="submit" id="pride-btn">Pride of Nigeria</button>
    </section>
   </div>

   <section>
    <h2>Other Essential Solutions</h2> <br>
    <div class="essential-items-container">
        <div class="essential-item">
            <a href="">
                <p class="e-title">E-Registry</p>
            <p>
                Seamlessly register your business online and step into the spotlight of relevance.
                Join countless entrepreneurs who have embraced the future of business registration.
                Sign up today and unlock endless opportunities for growth and recognition.
            </p>
            </a>
        </div>

        <div class="essential-item">
            <a href="">
                <p class="e-title">E-Registry</p> <br>

            <p>
                Streamline your registration process and
                take your business to new heights of relevance. Join a community of thriving entrepreneurs
                who have embraced the convenience and efficiency of online registration.
                Get started with E-Registry today and make your mark in the digital marketplace.
            </p>
            </a>
        </div>


        <div class="essential-item">
            <a href="">
                <p class="e-title">E-Certified</p> <br>
            <p>
               Gain official certification and stand out in your industry.
                Show your customers that you meet the highest standards of quality and professionalism.
                Become E-Certified today and unlock new levels of trust and credibility for your business."
            </p>
            </a>
        </div>



        <div class="essential-item">
           <a href="">
            <p class="e-title">E-Autos</p> <br>
            <p>
               Explore a world of innovation
                and convenience as you navigate the roads ahead. From buying and selling to maintenance
                and services, E-Autos is your ultimate destination for all things automotive.
                Join the E-Autos community and drive into the future today!
            </p>
           </a>
        </div>


    </div>

   </section>
   <section>
    <div class="short-video-header">
        <h2>Short Videos</h2>
        <a href="{{route('short_video.show-all-videos')}}" class="anchor">See All Videos</a>
    </div>
    <div class="swiper-container short-video-container">
        <div class="swiper-wrapper">
            <!-- Your video slides -->
            @foreach($shortVideos as $video)
            <div class="swiper-slide">
                <div class="short-video-item">
                    <div class="video-overlay">
                        <button class="play-button"></button>
                    </div>
                    <video class="video-player" controls>
                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="video-stats">
                        <div>
                            <i class="fas fa-heart"></i>
                            <span class="likes">{{ $video->likes }}</span>
                            <button class="like-button" data-video-id="{{ $video->id }}">Like</button>
                        </div>
                        <div>
                            <i class="fas fa-eye"></i>
                            <span class="views">{{ $video->views }}</span>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3>{{ $video->title }}</h3>
                        <p>{{ $video->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Navigation arrows -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <!-- Add pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 25,
        //  Add pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        // Add navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<!-- Include CSS to loaad the swipper class -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<style>

/* ===== SHORT VIDEO DESCRIPTION ====  This isn added here due to conflict with other css in the main.css file*/
.short-video-header {
    display: flex;
    justify-content: space-between;
}

.short-video-header button {
    width: 80px;
    height: 50px !important;
    padding: 0 !important;
    margin: 0 !important;
    padding: 5px 10px;
}

.short-video-container {
    overflow-x: auto;
    white-space: nowrap;
    padding: 20px 0;
    margin-top: 20px;
}

.short-video-item {
    position: relative;
    display: inline-block;
    width: 300px;
    margin: 0 10px;
}

.short-video-item video {
    max-height: auto;
    width: 100%;
    object-fit: cover;
}

video{
    width: 100%;
    height: 350px;
    margin-right: 15px
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.short-video-item:hover .video-overlay {
    opacity: 1;
}

.play-button {
    width: 80px;
    height: 80px;
    background-image: url('../news/play-button.png');
    background-size: cover;
    border: none;
    cursor: pointer;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
}

.play-button:hover {
    background-color: rgba(255, 255, 255, 0.6);
}

.video-stats {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 10px;
    background-color: rgba(0, 0, 0, 0.7);
}

.video-stats .likes,
.video-stats .views {
    padding: 2px 8px;
    border-radius: 5px;
}

.video-stats .likes i,
.video-stats .views i {
    margin-right: 5px;
}

.video-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    background-color: rgba(0, 0, 0, 0.7);
}

.video-info h3,
.video-info p {
    margin: 0;
    color: #fff;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}



/* Swiper container styles */
.swiper-container {
    width: 100%;
    position: relative;
}

.swiper-slide {
    width: auto;
    height: auto;
}

/* Hide pagination if not needed */
.swiper-pagination {
    display: none;
}

/* Swiper navigation arrow styles */
.swiper-button-prev,
.swiper-button-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
}

.swiper-button-prev {
    left: 10px;
}

.swiper-button-next {
    right: 10px;
}

.swiper-button-prev::before,
.swiper-button-next::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    border-top: 2px solid #000;
    border-left: 2px solid #000;
    transform: translate(-50%, -50%) rotate(-45deg);
}

.swiper-button-next::before {
    transform: translate(-50%, -50%) rotate(135deg);
}



</style>








   <section id="remembrance">
    <div class="news-header-container" >
        <div class="update-and-news-slider">
            <div class="news-update-slider">
                @php
                    // Filter only the highlighted posts for the slider
                    $remembrancePosts = $newsPosts->filter(function($post) {
                        return in_array($post->category, ['Remembrance', 'Memorial', 'Condolescence', 'Obituary']);
                    });
                @endphp

                @if ($remembrancePosts->isNotEmpty())
                    <div id="remembrance-slider-container">
                        @foreach ($remembrancePosts->sortByDesc('created_at') as $post)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="news update" class="remembrance-slider-img" style="width: 100%; height: 400px;">
                        @endforeach
                    </div>

                    <script>
                        var remembranceSliderImages = [
                            @foreach($remembrancePosts->sortByDesc('created_at') as $post)
                                "{{ asset('storage/' . $post->image) }}",
                            @endforeach
                        ];

                        var remembranceLen = remembranceSliderImages.length;
                        var remembranceIndex = 0;

                        function remembranceSlider() {
                            var remembranceSlideImage = document.getElementsByClassName("remembrance-slider-img")[0];

                            if (remembranceIndex >= remembranceLen) {
                                remembranceIndex = 0;
                            }

                            remembranceSlideImage.src = remembranceSliderImages[remembranceIndex];
                            remembranceIndex++;
                            setTimeout(remembranceSlider, 5000);
                        }

                        // Start the remembrance slider
                        remembranceSlider();
                    </script>
                @endif
            </div>


            <div class="news-category-container">
                <div class="news-update">
                    <a href="{{ route('category.show', 'Memorial') }}" class="new-cat">Memorial</a>
                    <a href="{{ route('category.show', 'Condolescence') }}" class="new-cat">Condolescence</a>
                    <a href="{{ route('category.show', 'Obituary') }}" class="new-cat">Obituary</a>
                    <a href="{{ route('category.show', 'Weather') }}" class="new-cat">Weather</a>
                    <a href="{{ route('category.show', 'Technology') }}" class="new-cat">Technology</a>
                    <a href="{{ route('category.show', 'Politician') }}" class="new-cat">Politician</a>
                </div>
            </div>

        </div>


        <!-- start of the headline section-->
        <div class="news-headline-container">
            <h3>Remembrance</h3>
            <!--- show the news headline-->
            <div class="news-headline">
                @php
                $isRemembranceExist = false;
                @endphp

                @foreach($newsPosts->sortByDesc('created_at')->take(10) as $post)
                    @if(($post->category == 'Remembrance' || $post->category == 'Memorial' || $post->category == 'Condolescence' || $post->category == 'Obituary') && $post->is_headline)
                        @php
                        $isRemembranceExist = true;
                        @endphp

                        <div class="news-headline-image">
                            @if($post->image)
                            <a href="{{ route('post.show', $post->id) }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                            </a>

                            @endif
                        </div>
                        <!----
                        <div class="news-headline-title">
                            <h2><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h2>
                        </div>
                    -->
                        <div class="remember-me">

                                    @if ($post->deceased_name)
                                        <p>{{ $post->deceased_name }}</p>
                                    @endif
                                    <p style="color: black">{{ $post->age }} years</p>


                        </div>

                        <p >
                            <a href="{{ route('post.show', $post->id) }}" style="color: black">{!! Illuminate\Support\Str::words(strip_tags($post->content), 20) !!}.... </a>
                        </p>
                        <br><br>
                    @endif
                @endforeach

                @if(!$isRemembranceExist)
                    <p>No post available for this category yet</p>
                @endif
            </div>


        </div>
        <!-- end of the news-container-headline-->
    </div>
</section>

<div class="family-tree">
    <h4> Start your family tree for free </h4>
    <p>Connect with your family ancestory and discover the where, what and who of how it leads to you</p>
    <div class="family-tree-button">
        <button type="submit" id="view-ancestry">View Ancestry</button>
        <button type="submit" id="build-tree-btn">Build Yout Tree</button>
    </div>
</div>


<div class="register-biz">
    <div class="register-caption">
        <h3>Register Now to get your Business Listed on Essential Direct</h3>
        <p>
            Join Essential Direct today and showcase your business to the world! Stand out in your industry and reach new customers effortlessly.
            With Essential Direct, your business will get the visibility it deserves.
            Don't miss out on this opportunity to grow your brand and increase your sales. Sign up now and take your business to the next level!
        </p>
        <button type="submit" style="margin-bottom: 30px">Register Now</button>
    </div>

    <div class="register-image">
        <img src="images/biz-reg.jpg" alt="E-direct business registration">
    </div>
</div>

<section>
    <div class="book-hotel-container">
        <h3>Book a hotel before leaving</h3>
        <div class="featured-hotel-container">
            <div class="hotel">
                <h6>Hundreds of 5-star reviews</h6>
                <p>Thanks for your first class quality and great value</p>
                <button>Book Now</button>
            </div>

            <div class="about-hotel">
                <h5>You will be amazed by what we have prepared for you</h5>
                <p>
                    Prepare to be enchanted by our warm hospitality and personalized service, crafted to exceed your expectations.
                    Whether you're traveling for business or leisure, our dedicated team is committed to making your stay a memorable one.
                </p>
            </div>
        </div>

        <div class="hotel-images">
            <img src="images/hotel2.jpeg" alt="">
            <img src="images/hotel3.jpeg" alt="">
            <img src="images/hotel4.jpeg" alt="">
        </div>
    </div>
</section>
<section>
    <div class="group-container">
        <div class="group-header">
            <h1>Groups You May Like</h1>
            <a href="/discussion" class="anchor">Join Hot Topic Discussions</a>
        </div>

        <div class="group-items-container">
            <div class="group-ad">
                <h4 class="title">Current Affairs</h4>
                <p class="description">
                    Stay informed and be part of lively discussions on the latest news stories shaping our world.
                    Our discussion group provides a platform to delve deeper into the issues that matter most to you.
                </p>
                <a href="/discussion" class="anchor">Join!</a>
            </div>

            <div class="group-ad">
                <h4 class="title">Diverse Perspectives</h4>
                <p class="description">
                    Join a diverse community of individuals from various backgrounds, each offering unique insights and perspectives.
                    Expand your understanding by engaging in thoughtful conversations with people who bring different viewpoints to the table.
                </p>
                <a href="/discussion" class="anchor">Join!</a>
              </div>

              <div class="group-ad">
                <h4 class="title">Voice Your Opinions</h4>
                <p class="description">
                    Your voice matters! Share your opinions, thoughts, and ideas on trending topics, and contribute to meaningful dialogues that help shape public opinion.
                    Our discussion group is a space where your input can make a real difference.
                </p>
                <a href="/discussion" class="anchor">Join!</a>
              </div>

              <div class="group-ad">
                <h4 class="title">Connect with Like-Minded Individuals</h4>
                <p class="description">
                    Connect with others who share your interests and passions.
                    Our discussion group is a place where you can find like-minded individuals to connect with, learn from, and build relationships with.
                </p>
                <a href="/discussion" class="anchor">Join!</a>
              </div>

              <div class="group-ad">
                <h4 class="title">Access Expert Analysis</h4>
                <p class="description">
                    Gain access to expert analysis and commentary on breaking news stories and current events.
                    Engage in discussions with professionals and experts in various fields to deepen your understanding and broaden your knowledge.
                </p>
                <a href="/discussion" class="anchor">Join!</a>
              </div>

              <div class="group-ad">
                <h4 class="title">Stay Civically Engaged</h4>
                <p class="description">
                    Being part of our discussion group is not just about staying informed; it's about actively participating in civil discourse and contributing to a more informed and engaged society.
                    Join us in fostering a culture of constructive dialogue and civic engagement.
                </p>
                <a href="/discussion" class="anchor">Join!</a>
              </div>


        </div>
    </div>
</section>


@endsection


