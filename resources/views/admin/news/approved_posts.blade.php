<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Posts</title>
    <link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">
</head>
<body>
    
    
    <div class="manager-header">
        <h2>APPROVED POSTS</h2>
        <a href="{{ route('admin.news.create') }}" target="_blank">Submit A Post News</a>
    </div>
    
    
    <div class="search-container">
        <input type="search" name="search" id="search" placeholder="Search..." onkeyup="searchTable()">
    </div>
    
    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>News Title</th>
                <th>Category</th>
                <th class="actions">Actions</th>                
            </tr>
        </thead>
        <tbody>
            @foreach($approvedPosts->reverse() as $key => $post)
            <tr id="post{{ $key + 1 }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category }}</td>
                <td class="actions">
                    <a href="{{ route('post.show', $post->id) }}" style="background-color: darkgreen; color: white; padding:8px">View</a>
                    <a href="{{ route('admin.news.edit', $post->id) }}">Edit</a>
                    <form action="{{ route('admin.news.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                </td>
        
               
            </tr>
        @endforeach
        
        <script>
            function confirmAction(action) {
                return confirm(`Are you sure you want to ${action.toLowerCase()} this post?`);
            }
        </script>
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
    
</body>
</html>

