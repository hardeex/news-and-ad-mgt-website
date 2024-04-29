<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-News Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-QLIq7Fqhj07dJ/oDKC4RApV5V4PPX0Xr2lryREs2znPm6wOhAMfcJC9uKn+5aWjZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-rHK8Yvo0Hq21bHk1hiOPpGWT1H8wvcPb11TPFqEadFk5BdCiA/pz5wr5bx6F7bMd" crossorigin="anonymous">




<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/main.js') }}" defer></script>

</head>

<body>


  <style>
    form {
    max-width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 0.5rem;
}

input[type="text"],
textarea,
input[type="file"],
input[type="url"] {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
}

button[type="submit"] {
    background-color: darkred;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    margin-top: 0.5rem;
}

  </style>

  <div class="dashboard">
    <div class="sidebar">
      
      <div class="dashboard-header" style="display: flex; justify-content:space-between">
        <h2 style="margin-bottom: 5rem">Dashboard</h2>
       
       
        
      
      </div>
      
      <ul>
        <li><a href="#" class="tablinks" onclick="openTab(event, 'view-website')">Posts Charts</a></li>  
        <li><a href="#" class="tablinks" onclick="openTab(event, 'view-website')">View Website</a></li>                
        <li><a href="#"  onclick="openTab(event, 'manage-post')"> Manage Posts</a></li>         
        <li><a href="#" class="tablinks" onclick="openTab(event, 'manage-ads')"> Manage Ad & Live Video </a></li>                            
        <li><a href="#" class="tablinks" onclick="openTab(event, 'manage-short-video')"> Manage Short Videos </a></li>     
        <li><a href="#" class="tablinks" onclick="openTab(event, 'manage-group')"> Manage Group </a></li> 
        <li><a href="{{  route('admin.register') }}" target="_blank">Add News Editor </a></li>    
      </ul>
    </div>
  
    <div class="content">
      <div class="admin-header-info" style="display: flex; align-items: center; justify-content: space-between; padding: 10px; background-color: #f0f0f0;">
        <div class="toggle-menu" style="color: red; font-size: 1.4rem;">
            <input type="checkbox" id="menu-toggle" class="menu-toggle-checkbox">
            <label for="menu-toggle" class="menu-toggle-label">
                <i class="fas fa-bars"></i>
            </label>
        </div>
    
        <div class="admin-info" style="display: flex; align-items: center;">
            <!-- Authentication -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
    
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
    
    
      
      <div id="view-website" class="tabcontent" style="display: block;">
        <h2>Post Charts</h2>
          <iframe src="{{ route('user.graph') }}" frameborder="0" width="100%" height="500"></iframe>
      </div>
      <!---- End of the view website section-->

      
      <div id="view-website" class="tabcontent">
        <h2>Visit Website</h2>
        <iframe src="{{ route('index') }}" frameborder="0" width="100%" height="500"></iframe>
      </div>
  
        <!--- End of creatingpost--->

      <!---- start of managing published post-->
      <div id="manage-post" class="tabcontent" >
        <h2>Manage Published News Post</h2>
        <iframe src="{{ route('admin.news.index') }}" frameborder="0" width="100%" height="500"></iframe>
      </div>

      
      
      <div id="manage-ads" class="tabcontent" >
        <h2>Manage Ads Banner & Live Video</h2>
        <iframe src="{{ route('news.adlivmanage') }}" frameborder="0" width="100%" height="500"></iframe>
      </div>

    

      <div id="manage-short-video" class="tabcontent" >
        <h2>Manage Short Video</h2>
        <iframe src="{{ route('short_video.index') }}" frameborder="0" width="100%" height="500"></iframe>
      </div>

      <div id="manage-group" class="tabcontent" >
        <h2>Manage Group</h2>
        <iframe src="{{ route('group.index') }}" frameborder="0" width="100%" height="500"></iframe>
      </div>

      


    </div>
  </div>
  



  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menu-toggle");
        const sidebar = document.querySelector(".sidebar");

        menuToggle.addEventListener("click", function () {
            sidebar.classList.toggle("open");
        });
    });
</script>


</body>
</html>
