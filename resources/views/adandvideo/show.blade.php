@extends('base.base')
@section('link')

@section('page-content')

<section>
    <style>

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

p {
    font-size: 16px;
    margin-bottom: 20px;
}

img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
}

video {
    width: 100%;
    height: auto;
    margin-bottom: 20px;
}

.container a {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.container a:hover {
    background-color: #0056b3;
}


        </style>

     <div class="container">
        <h1>{{ $adlive->title }}</h1>
        <p>Description: {{ $adlive->description }}</p>
       
        
       
        @if ($adlive->vertical_ad)
        <img src="{{ asset('storage/' . $adlive->vertical_ad) }}" alt="{{ $adlive->title }} Vertical Ad Image">
        @endif

        @if ($adlive->horizontal_ad)
        <img src="{{ asset('storage/' . $adlive->horizontal_ad) }}" alt="{{ $adlive->title }} Horizontal Ad Image">
        @endif

        @if ($adlive->video_upload)
        
        <video controls width="100%">
            <source src="{{ asset('storage/' . $adlive->video_upload) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        @endif


        <br><br>
    
        <a href="{{ route('news.adlivmanage') }}">Back to Adlive List</a>
    </div>
</section>
   
@endsection
