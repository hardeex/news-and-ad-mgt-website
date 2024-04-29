<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit News Post</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

      <!--- adding ckeditor cdn link -->
      <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
</head>
<body>


        <style>
            body{
                padding: 3.3rem
            }
        </style>
    <h2>Edit News Post</h2>
    <section>

    <form action="{{ route('admin.news.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $post->title }}"><br>

        <label for="content">Content:</label><br>
        <!-- Replace the textarea with CKEditor -->
        <textarea id="editor" name="content">{{ $post->content }}</textarea><br>

        <!-- Display the existing image if it exists -->
        @if ($post->image)
        <label for="existing_image">Existing Image:</label><br>
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} Image"><br>
        @endif


        <h5 style="font-size: 1.3rem; text-align:center">For the Remembrance/Obituary Section</h5>
        <!---- Handlng other section of REMEMBRANCE PART OF THE PAGE --->
        <label for="deceased_name">Name of the Deceased</label>
        <input type="text" name="deceased_name" id="deceased_name" value="{{ old('deceased_name') }}"><br>

        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="{{ old('age') }}"> <br>
        <br><br>



        <!-- Add file input field for uploading a new image -->
        <label for="upload_image">Upload Image:</label><br>
        <input type="file" id="upload_image" name="upload_image"><br><br><br><br>

        <div class="checkbox" style="display: flex; justify-content:space-evenly ">
            <label for="is_featured">Is Featured:</label>
            <input type="checkbox" id="is_featured" name="is_featured" {{ $post->is_featured ? 'checked' : '' }}><br>

            <label for="is_trending">Is Trending:</label>
            <input type="checkbox" id="is_trending" name="is_trending" {{ $post->is_trending ? 'checked' : '' }}><br>

            <label for="is_headline">Is Headline:</label>
            <input type="checkbox" id="is_headline" name="is_headline" {{ $post->is_headline ? 'checked' : '' }}><br>

            <label for="top_topic">Top Topic:</label>
            <input type="checkbox" id="top_topic" name="top_topic" {{ $post->top_topic ? 'checked' : '' }}><br>
        </div>

        <br><br><br>
        <label for="category">Category:</label><br>

        <select id="category" name="category">
            @foreach ($categories as $categoryId => $categoryName)
                <option value="{{ $categoryId }}" {{ $post->category == $categoryName ? 'selected' : '' }}>
                    {{ $categoryName }}
                </option>
            @endforeach
        </select><br>

        <br>



        <button type="submit" style="margin-top: 20px">Update</button>
    </form>

    </section>
    <!-- Include CKEditor script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

    <!-- Initialize CKEditor for the content field -->
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
</body>
</html>
