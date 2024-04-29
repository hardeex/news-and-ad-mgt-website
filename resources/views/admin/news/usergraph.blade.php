<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Post Graph</title>
    <link rel="stylesheet" href="{{ asset('css/user_post_graph.css') }}">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <div class="manager-header" style="display: flex; justify-content:space-between">
        <div>
             <h2>Number of Posts Published by Users</h2>
        </div>
       
       
        <div>
            <div>
                <a href="{{ route('user.graph') }}">View Post Graph</a>
            </div>
        </div>
    </div>
    
    <!-- Display the bar chart -->
    <canvas id="postChart" width="400" height="200"></canvas>
    
    <!-- JavaScript code for creating the chart -->
    <script>
        // Retrieve the data for the chart
        const userNames = {!! json_encode($userNames) !!};
        const postCounts = {!! json_encode($postCounts) !!};

        // Create the chart
        const ctx = document.getElementById('postChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: userNames,
                datasets: [{
                    label: 'Number of Posts',
                    data: postCounts,
                    backgroundColor: 'rgba(154, 168, 240, 0.5)',
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
    </script>
</body>
</html>
