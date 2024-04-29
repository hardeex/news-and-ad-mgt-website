<!--- adding the base layout -->
@extends('base.base')
<!-- adding the page title-->
@section('title', 'Page Not Found')
<!---Adding the styling and js links-->
@section('link')
    
@endsection

@section('page-content')
<section>
    <div class="not-found">
        <div class="notfound-txt">
            <h3 style="text-transform: none">An Invalid Page Request</h3>                                                                        
            <!---Remember to redirect the users to the home page upon handling the core aspect of the project-->
        </div>
    
        <div class="aside-container">
            <!------- Handling this section to show recent news-->
        </div>

        
        
    </div>

</section>
@endsection