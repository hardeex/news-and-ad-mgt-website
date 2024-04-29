<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Content Template</title>
<link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>
<body>

<div class="header-container">
  <div class="header active" onclick="showContent('create', this)">Create Short Videos</div>
  <div class="header" onclick="showContent('all-posts', this)">Manage Short Video</div>
</div>


<div class="content" id="create">
    <h2> SHORT VIDEO </h2>
    <div class="ads-and-video">

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
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Upload complete
                        progressBarContainer.style.display = 'none';

                    }
                };

                xhr.send(formData);

                progressBarContainer.style.display = 'block';
            });
        </script>

    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    </div>
</div>


<div class="content" id="all-posts">
    <div class="search-container">
        <input type="search" name="search" id="search" placeholder="Search..." onkeyup="searchTable()">
    </div>

    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Video Title</th>
                <th>Description</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shortVideos->reverse() as $key => $post)
                <tr id="post{{ $key + 1 }}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td class="actions">
                        <a href="{{ route('short_video.show', $post->id) }}" style="background-color: darkgreen; color: white; padding:8px">View</a>
                        <a href="{{ route('short_video.edit', $post->id) }}">Edit</a>
                        <form action="{{ route('short_video.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function searchTable() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</div>



<script>
function showContent(id, element) {
  var contents = document.getElementsByClassName("content");
  for (var i = 0; i < contents.length; i++) {
    contents[i].style.display = "none";
  }
  document.getElementById(id).style.display = "block";

  var headers = document.getElementsByClassName("header");
  for (var i = 0; i < headers.length; i++) {
    headers[i].classList.remove("active");
  }
  element.classList.add("active");
}

// Triggering click event on initially active tab
window.onload = function() {
  var initiallyActiveHeader = document.querySelector('.header.active');
  initiallyActiveHeader.click();
};
</script>

</body>
</html>
