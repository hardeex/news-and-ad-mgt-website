<!--- adding the base layout -->
@extends('base.dashboard')
<!-- adding the page title-->
@section('title', 'E-News Upload Video')
<!---Adding the styling and js links-->
@section('link')
    <link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">

@endsection

@section('page-content')

<section>


        <h2> UPLOAD NEWS SHORT VIDEO </h2>
        <div class="ads-and-video">

            @if(session('success'))
            <div class="success">{{ session('success') }}</div>
            @endif

            <form id="uploadForm" action="{{ route('short_videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="{{ old('title') }}"><br>

                <label for="description">Description:</label><br>
                <textarea id="description" name="description">{{ old('description') }}</textarea><br>

                <label for="short_video">Video Upload:</label><br>
                <input type="file" id="short_video" name="short_video" accept="video/mp4, video/mov, video/avi"><br>

                <button type="submit">Upload</button>
            </form>

            <div id="progressBarContainer" style="display: none;">
                <progress id="progressBar" value="0" max="100"></progress>
                <span id="progressPercentage">0%</span>
            </div>


            <script>
                document.getElementById('uploadForm').addEventListener('submit', function(event) {
                    event.preventDefault();

                    var form = this;
                    var formData = new FormData(form);

                    var progressBarContainer = document.getElementById('progressBarContainer');
                    var progressBar = document.getElementById('progressBar');
                    var progressPercentage = document.getElementById('progressPercentage');

                    var xhr = new XMLHttpRequest();

                    xhr.upload.addEventListener('progress', function(event) {
                        var percent = (event.loaded / event.total) * 100;
                        progressBar.value = percent;
                        progressPercentage.textContent = percent.toFixed(2) + '%';
                    });

                    xhr.open('POST', form.action);
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            progressBarContainer.style.display = 'none';
                            if (xhr.status === 200) {
                                // Upload successful
                                var response = JSON.parse(xhr.responseText);
                                // Handle response if needed
                                console.log(response);
                                window.location.reload();
                            } else {
                                // Upload failed
                                console.error('Upload failed:', xhr.status);
                                // Handle error in UI
                            }
                        }
                    };

                    xhr.send(formData);

                    progressBarContainer.style.display = 'block';
                });
            </script>




        </div>
</section>
@endsection
