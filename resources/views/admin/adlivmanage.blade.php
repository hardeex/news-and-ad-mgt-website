<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Content Template</title>
<link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">


</head>
<body>

<div class="header-container">
  <div class="header active" onclick="showContent('create', this)">Create</div>
  <div class="header" onclick="showContent('all-posts', this)">All Posts</div>

</div>


<div class="content" id="create">
    <h2> Ads & Live Video </h2>
        <div class="ads-and-video">
        
        <form action="{{ route('store_ad_and_video') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror<br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror<br>
        
            <label for="vertical_ad">Vertical Ad Image:</label><br>
            <input type="file" id="vertical_ad" name="vertical_ad">
            @error('vertical_ad')
                <div class="error">{{ $message }}</div>
            @enderror<br>
        
            <label for="horizontal_ad">Horizontal Ad Image:</label><br>
            <input type="file" id="horizontal_ad" name="horizontal_ad">
            @error('horizontal_ad')
                <div class="error">{{ $message }}</div>
            @enderror<br>
        
            <label for="video_upload">Video Upload:</label><br>
            <input type="file" id="video_upload" placeholder="20MB max file-size" name="video_upload" accept="video/mp4, video/mov, video/avi">
            @error('video_upload')
                <div class="error">{{ $message }}</div>
            @enderror<br>
        
            <label for="video_link">Video Link:</label><br>
            <input type="url" id="video_link" name="video_link" value="{{ old('video_link') }}">
            @error('video_link')
                <div class="error">{{ $message }}</div>
            @enderror<br>
        
            <button type="submit">Submit</button>
        </form>
        
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
                <th>Title</th>
                <th>Description</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adlive as $key => $item)
            <tr id="item{{ $key + 1 }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td class="actions">
                    <a href="{{ route('adlive.show', ['id' => $item->id]) }}" style="background-color: darkgreen; color: white; padding:8px">View</a>
                    <a href="{{ route('adlive.edit', ['id' => $item->id]) }}">Edit</a>
                    <form action="{{ route('adandvideo.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this ad and video?')">Delete</button>
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
