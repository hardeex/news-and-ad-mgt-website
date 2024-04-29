<!--- adding the base layout -->
@extends('base.base')
<!-- adding the page title-->
@section('title', $searchTerm)
<!---Adding the styling and js links-->
@section('link')
    
@endsection


@section('page-content')
    

      <section>
                <h1>Search Results for "{{ $searchTerm }}"</h1>
          <!-- Check if any results were found -->
          @if($isEmpty)
                <p>No results found for your search term.</p>
        @else
          <!-- Display News Post Results -->
          
          @if($results['newsResults']->isEmpty())
             
          @else
              <ul>
                @foreach($results['newsResults'] as $result)
                <li>
                    <p>Results were found in the following posts:</p> <br>
                    TOPIC TITLE: <a href="{{ route('post.show', ['id' => $result->id]) }}">{{ $result->title }}</a> <br>
                   TOPIC CATEGORY <a href="{{ route('post.show', ['id' => $result->id]) }}">{{$result->category }}</a>
                   <br> <a href="{{ route('post.show', ['id' => $result->id]) }}">{!! Illuminate\Support\Str::words(strip_tags($result->content), 40) !!}</a>

                   
                </li>
            @endforeach
            
              </ul>
          @endif
  
          <!-- Display Ad and Video Results -->
         
          @if($results['adResults']->isEmpty())
             
          @else
              <ul>
                  @foreach($results['adResults'] as $result)
                  <li>
                    <a href="{{ route('post.show', ['id' => $result->id]) }}">{{ $result->title }}</a>
                    <a href="{{ route('post.show', ['id' => $result->id]) }}">{{ $result->description }}</a>
                  </li>
                       
                  @endforeach
              </ul>
          @endif
  
          <!-- Display Category Results -->
         
          @if($results['categoryResults']->isEmpty())
              
          @else
              <ul>
                  @foreach($results['categoryResults'] as $result)
                      <li>  <a href="{{ route('post.show', ['id' => $result->name]) }}">{{ $result->name }}</a></li> 
                  @endforeach
              </ul>
          @endif
  
          <!-- Display Short Video Results -->
          
          @if($results['shortVideoResults']->isEmpty())
              
          @else
              <ul>
                  @foreach($results['shortVideoResults'] as $result)
                      <li> <a href="{{ route('post.show', ['id' => $result->id]) }}">{{ $result->title }}</a> </li> 
                      <a href="{{ route('post.show', ['id' => $result->id]) }}">{{ $result->description }}</a>
                  @endforeach
              </ul>
          @endif
      @endif

  @endsection

      </section>
</body>
</html>
