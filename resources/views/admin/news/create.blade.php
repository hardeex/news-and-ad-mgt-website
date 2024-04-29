<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News Post</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!--- adding ckeditor cdn link -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
</head>
<style>
      .ck-editor__editable_inline{
        height: 500px;
    }
</style>
<body>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            padding: 3rem
        }

    </style>

    <h2>E-News Post Submission</h2>


@auth




    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ old('title') }}"><br>

        <label for="content">Content:</label><br>
        <textarea name="content" id="editor">{{ old('content') }}</textarea><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" alt=""><br> <br><br>

        <h5 style="font-size: 1.3rem; text-align:center">For the Remembrance/Obituary Section</h5>
        <!---- Handlng other section of REMEMBRANCE PART OF THE PAGE --->
        <label for="deceased_name">Name of the Deceased</label>
        <input type="text" name="deceased_name" id="deceased_name" value="{{ old('deceased_name') }}"><br>

        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="{{ old('age') }}"> <br>
        <br><br>

        <div class="checkbox" style="display: flex; justify-content:space-evenly ">
            <label for="is_featured" >Is Featured:</label>
            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}><br>

            <label for="is_trending">Is Trending:</label>
            <input type="checkbox" id="is_trending" name="is_trending" value="1" {{ old('is_trending') ? 'checked' : '' }}><br>

            <label for="is_headline">Is Headline:</label>
            <input type="checkbox" id="is_headline" name="is_headline" value="1" {{ old('is_headline') ? 'checked' : '' }}><br>

            <label for="top_topic">Top Topic:</label>
            <input type="checkbox" id="top_topic" name="top_topic" value="1" {{ old('top_topic') ? 'checked' : '' }}><br>
        </div><br><br>





        <label for="category">Category:</label><br>
        <select id="category" name="category">
            @foreach ($categories as $id => $name)
                <option value="{{ $id }}" {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select><br>
        <button type="submit" style="margin-top: 20px">Create</button>
    </form>

    <script>

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder:{
                    uploadUrl: "{{ route('ckeditor.upload', ['_token'=>csrf_token()])}}",
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@else

    <h2>Kindly, <a href="{{ route('login') }}">Login</a> with your user account to submit posts</h2>
@endauth

</body>
</html>
