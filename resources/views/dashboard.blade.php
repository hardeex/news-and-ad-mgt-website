<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ Auth::user()->name }} E-News Dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
<body>

    <style>

  /* Basic CSS Reset */
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Global Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.main-content {
    flex-grow: 1;
    display: flex;
}

span{
    color: white;
}

.sidebar {
    width: 250px;
    background-color: darkblue;
    color: #fff;
    padding: 20px;
    position: fixed;
    top: 0;
    left: -250px;
    height: 100%;
    overflow-y: auto;
    transition: left 0.3s ease-in-out;
}

.sidebar.active {
    left: 0;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 40px;
}

.sidebar ul li a{
    margin-left: 2rem;

}

.sidebar a:hover {
    color: darkorange;
}



.sidebar a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
}

.sidebar a.active {
    font-weight: bold;
    color: darkorange;
}

.dashboard {
    flex-grow: 1;
    display: grid;
    grid-template-columns: repeat(2, minmax(300px, 1fr));
    padding: 20px;
}



.widget {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.widget h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

/* Responsive Styles */
@media screen and (max-width: 576px) {
    .dashboard {
        grid-template-columns: 1fr;
    }
}

@media screen and (max-width: 992px) {
    .sidebar {
        width: 200px;
    }
}

@media screen and (max-width: 576px) {
    .sidebar {
        width: 150px;
    }
}

</style>

<div class="container">
    <header style="display: flex; justify-content:space-around">
        <div style="font-size: 2rem">Welcome {{ Auth::user()->name }}</div>

        <div>

                    <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" style="background-color: #f44336; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            @csrf

            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" style="color: white; text-decoration: none;">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>

        </div>

        <div>
             <!-- <button class="sidebar-toggle" onclick="toggleSidebar()">Show/Hide Menu</button> -->
             <span style="font-size: 30px; color: white; cursor: pointer;" onclick="toggleSidebar()">&#9776;</span>
        </div>


    </header>
    <div class="main-content">
        <nav class="sidebar" id="sidebar">
            <ul>
                <li><i class="fas fa-user"></i><a href="#" class="sidebar-item" data-target="widget1">My Posts</a></li>
                <li><i class="fas fa-flag"></i><a href="#" class="sidebar-item" data-target="widget2">Report</a></li>
                <li><i class="fas fa-user-circle"></i><a href="{{ route('profile.edit') }}" >Profile</a></li>
                <li><i class="fas fa-plus-square"></i><a href="#" class="sidebar-item" data-target="widget4">Submit Post</a></li>
                <li><i class="fas fa-video"></i><a href="#" class="sidebar-item" data-target="widget5">Upload News Video</a></li>
                <li><i class="fas fa-film"></i><a href="#" class="sidebar-item" data-target="widget6">Manage Videos</a></li>
                <li><i class="fas fa-comments"></i><a href="/discussion" target="_blank">Join Discussion</a></li>
            </ul>
        </nav>
        <div class="dashboard">
            <div class="widget" id="widget1">
                <iframe src="{{ route('user.posts') }}" frameborder="0" width="100%" height="800"></iframe>
            </div>
            <div class="widget" id="widget2">
                <iframe src="{{ route('user.graph') }}" frameborder="0" width="100%" height="800"></iframe>
            </div>

            <div class="widget" id="widget4">
                <h2>Submit Post(s)</h2>
                <iframe src="{{ route('admin.news.create') }}" frameborder="0" width="100%" height="800"></iframe>
            </div>
            <div class="widget" id="widget5">
                <h2>Upload News Videos</h2>
                <iframe src="{{ route('short_videos.create') }}" frameborder="0" width="100%" height="800"></iframe>
            </div>
            <div class="widget" id="widget6">
                <h2>Manage News Videos</h2>
                <iframe src="{{ route('short_videos.myvideos') }}" frameborder="0" width="100%" height="800"></iframe>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
    }

    // Get all sidebar items
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    // Add click event listener to each sidebar item
    sidebarItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');

            // Remove 'active' class from all sidebar items
            sidebarItems.forEach(item => {
                item.classList.remove('active');
            });

            // Add 'active' class to the clicked sidebar item
            this.classList.add('active');

            // Show the corresponding widget and hide others
            const widgets = document.querySelectorAll('.widget');
            widgets.forEach(widget => {
                if (widget.id === target) {
                    widget.style.display = 'block';
                } else {
                    widget.style.display = 'none';
                }
            });
        });
    });
</script>

</body>
</html>
