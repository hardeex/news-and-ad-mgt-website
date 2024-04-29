<!--- adding the base layout -->
@extends('base.base')
<!-- adding the page title-->
@section('title', 'E-News Groups')
<!---Adding the styling and js links-->
@section('link')
    <link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">
    
@endsection


@section('page-content')

<section>
  
<style>
  .header-container {
    display: flex;
    justify-content: space-between;
  }
  .header {
    cursor: pointer;
    padding: 10px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    margin-bottom: 5px;
    flex: 1;
    text-align: center;
  }
  .active {
    background-color: #4CAF50;
    color: white;
  }
  .content {
    display: none;
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
  }
</style>
</head>
<body>

<div class="header-container">
  <div class="header active" onclick="showContent('all-pots', this)">All Groups</div>
  <div class="header" onclick="showContent('published', this)">My Groups</div>
  <div class="header" onclick="showContent('pending', this)">Create A Group</div>
  <div class="header" onclick="showContent('rejected', this)">Other Groups</div>
</div>

<div class="content" id="all-pots">
  <!-- Content for "All Pots" -->
  <p>This is the content for All Pots.</p>
</div>

<div class="content" id="published">
  <!-- Content for "Published" -->
  <p>This is the content for Published.</p>
</div>

<div class="content" id="pending">
  <!-- Content for "Pending" -->
  <p>This is the content for Pending.</p>
</div>

<div class="content" id="rejected">
  <!-- Content for "Rejected" -->
  <p>This is the content for Rejected.</p>
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
</script>

</section>
  
@endsection

