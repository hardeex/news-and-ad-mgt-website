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
  <div class="header" onclick="showContent('published', this)">Approved</div> 
  <div class="header" onclick="showContent('pending', this)">Pending</div>
  <div class="header" onclick="showContent('rejected', this)">Rejected</div>
</div>


<div class="content" id="create">
    <h2>Create Post</h2>
    <iframe src="{{ route('admin.news.create') }}" frameborder="0" width="100%" height="500"></iframe>
</div>


<div class="content" id="all-posts">
    <h2>All Posts</h2>
    <iframe src="{{ route('admin.news.post') }}" frameborder="0" width="100%" height="500"></iframe>
</div>

<div class="content" id="published">
    <h2>Approved Posts</h2>
    <p>This is the list of posts show to the users</p>
    <iframe src="{{ route('admin.news.approved_posts') }}" frameborder="0" width="100%" height="500"></iframe>
</div>

<div class="content" id="pending">
    <h2>Pending Posts</h2>
    <iframe src="{{ route('admin.news.pending') }}" frameborder="0" width="100%" height="500"></iframe>
</div>

<div class="content" id="rejected">
    <h2>Rejected Posts</h2>
    <iframe src="{{ route('admin.news.rejected_post') }}" frameborder="0" width="100%" height="500"></iframe>
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
