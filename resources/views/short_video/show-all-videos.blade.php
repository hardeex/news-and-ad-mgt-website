<!-- Adding the base layout -->
@extends('base.base')

<!-- Adding the page title -->
@section('title', 'E-News Short Videos')

<!-- Adding the styling and js links -->
@section('link')
    <!-- Add your CSS links here if needed -->
@endsection






@section('page-content')




<section class="short-video-section">
    <div class="short-video-header">
        <h2>Short Videos</h2>     
         
    </div>
    <div class="short-video-container">                   
        @foreach($shortVideos as $video)
            <div class="short-video-item">
                <div class="video-overlay">
                    <button class="play-button"></button>
                </div>
                <video class="video-player" controls>
                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="video-stats">
                    {{-- <div>
                        <i class="fas fa-heart"></i>
                        <span class="likes">{{ $video->likes }}</span>
                        <button class="like-button" data-video-id="{{ $video->id }}">Like</button>
                    </div> --}}
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
        @endforeach        
    </div>

   


<!-- Pagination Section -->
<div class="pagination-section">
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center flex-wrap">
                @if ($shortVideos->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Prev</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $shortVideos->previousPageUrl() }}">Prev</a></li>
                @endif
                
                @foreach ($shortVideos->getUrlRange(1, $shortVideos->lastPage()) as $page => $url)
                    <li class="page-item {{ ($page == $shortVideos->currentPage()) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                @if ($shortVideos->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $shortVideos->nextPageUrl() }}">Next</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>
</div>


</section>

<style>
.short-video-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
    gap: 30px;
    padding: 15px;
}

.short-video-item {
    background-color: #f5f5f5;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.short-video-item video {
    width: 100%;
    height: 350px;
}

.video-stats,
.video-info {
    padding: 10px;
}

.video-stats div {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.video-stats i {
    margin-right: 5px;
}

.pagination-section {
    margin-top: 20px;
}

.pagination-section ul.pagination {
    margin: 0;
}

.pagination-section ul.pagination li.page-item {
    display: inline-block;
    margin-right: 5px;
}

.pagination-section ul.pagination li.page-item a.page-link {
    color: #007bff;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #007bff;
    border-radius: 3px;
}

.pagination-section ul.pagination li.page-item a.page-link:hover {
    background-color: #007bff;
    color: #fff;
}

.pagination-section ul.pagination li.page-item.active a.page-link {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

</style>


@endsection
