
@extends('base.base')

@section('title', $post->title)


@section('page-content')

<section>
<style>
@media (max-width: 768px) {
    .not-found {
        flex-direction: column;
    }

    .post,
    .aside-container {
        width: 100%;
    }
}
</style>
    <div class="not-found">
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p class="meta">
                Posted on: {{ $post->created_at->format('M d, Y') }} | By <strong>{{ $post->user->name }} </strong>
                @if($post->category)
                @if(is_string($post->category))
                 Category: <a href=""><span class="category">{{ $post->category }}</span> </a>
            @else
                Category: <a href=""> <span class="category">{{ $post->category->name }}</span></a>
            @endif

                @endif
                Estimated Read Time: <span class="read-time">{{ calculateReadTime($post->content) }} min read</span>
            </p>
            <hr>
            @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image" style="margin-top: 1.2rem">
                @endif

                <div>{!! $post->content !!}</div>

        </div>





    <div class="aside-container">
        <h2>Recent News</h2>
        <ul>
            @foreach ($recentPosts as $recentPost)
                <li>
                    @if($recentPost->image)
                        <img src="{{ asset('storage/' . $recentPost->image) }}" alt="{{ $recentPost->title }} Image">
                    @endif
                    <a href="{{ route('post.show', $recentPost->id) }}" style="font-size: 1.2rem; color: rgb(43, 22, 22); margin-bottom: 20px">{{ $recentPost->title }}</a>
                </li>
            @endforeach
        </ul>


        <br><br>
        <div class="category-list">
            <h2>Categories</h2>
            <ul>
                @foreach ($categories as $category)
                    <li><a href="{{ route('category.show', $category->name) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
    </div>

</section>


@endsection
