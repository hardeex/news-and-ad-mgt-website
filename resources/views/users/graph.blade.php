<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approved Posts</title>
    <link rel="stylesheet" href="{{ asset('css/adminpost.css') }}">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="manager-header">
        <div>
            <h2>POSTS CHARTS</h2>
            <a href="{{ route('admin.news.create') }}" target="_blank">Submit Post</a>
        </div>

    </div>

    <!-- Display the bar chart -->
    <canvas id="postChart" width="400" height="200"></canvas>

    <div class="search-container">
        <input type="search" name="search" id="search" placeholder="Search..." onkeyup="searchTable()">
    </div>

    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>News Title</th>
                <th>Category</th>

            </tr>
        </thead>
        <tbody>
            @foreach($approvedPosts->reverse() as $key => $post)
            <tr id="post{{ $key + 1 }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category }}</td>
                {{-- <th class="actions">Actions</th>           --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- JavaScript code for creating the chart -->
    <script>
        // Retrieve the data for the chart
        const postCategories = {!! json_encode($postCategories) !!};
        const postCounts = {!! json_encode($counts) !!};

        // Create the chart
        const ctx = document.getElementById('postChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: postCategories,
                datasets: [{
                    label: 'Number of Posts',
                    data: postCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Function to filter table rows based on search input
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

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
