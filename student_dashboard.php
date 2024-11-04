<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="./admin/styles.css"> <!-- Add a CSS file for styling -->
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <a onclick="location.href='?action=reload'">Dashboard</a>
            <a href="#" onclick="loadContent('book_hostel.html'">Booking Request</a>
            <a href="#" onclick="loadContent('profile.php')">Profile</a>
            <a href="#" onclick="loadContent('request_status.php')">Request Status</a>
        </div>
        <div class="main-content" id="content-area">
            <!-- Content for each section will be loaded here -->
        </div>
    </div>
    
    <script>

        function toggleDropdown() {
            event.target.nextElementSibling.classList.toggle("show");
        }
        // Function to load content dynamically into #content-area without page reload
        function loadContent(page) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('content-area').innerHTML = this.responseText;
                }
            }
            xhr.send();
        }
    </script>

</body>
</html>
