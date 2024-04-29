<!--- adding the base layout -->
@extends('base.dashboard')
<!-- adding the page title-->
@section('title', 'E-News Uploaded Videos')
<!---Adding the styling and js links-->
@section('link')
    <link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">

@endsection



@section('page-content')

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
                    {{-- <form action="{{ route('short_video.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                    </form> --}}
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

@endsection
