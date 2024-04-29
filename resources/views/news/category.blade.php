@extends('base.base')

@section('title', $category->name)

@section('page-content')
<section>
    @if ($newsPosts->isEmpty())
        <p>No news posts available for this category.</p>
    @else
        <div class="post-grid">
            @foreach ($newsPosts->sortByDesc('created_at') as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image">
                @endif
                <p class="meta">

                    Posted on {{ $post->created_at->format('M d, Y') }} | By <strong>{{ $post->user->name }} </strong>

                    @if($post->category)
                    @if(is_string($post->category))
                    <span class="category">{{ $post->category }}</span>
                @else
                    <span class="category">{{ $post->category->name }}</span>
                @endif

                    @endif
                    <span class="read-time">{{ calculateReadTime($post->content) }} min read</span>
                </p>
                <p class="excerpt">{!! Illuminate\Support\Str::words(strip_tags($post->content), 120) !!}</p>
                <a href="{{ route('post.show', $post->id) }}" class="read-more">Read more</a>
                <!-- I intend to link social media here -->
            </div>

            @endforeach
        </div>
    @endif
</section>

<aside>
   <!--- <h2>Recent News</h2>-->
    <ul>
        <ul>
            <!----
            @foreach ($recentPosts as $recentPost)
                <li>

                    <a href="{{ route('post.show', $recentPost->id) }}">
                        @if ($recentPost->image)
                        <img src="{{ $post->image }}" alt="{{ $post->title }}">
                        @endif
                        {{ $recentPost->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    -->
    </ul>
</aside>
@endsection
