<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theretowhere - Travel & Booking</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff6f61, #6b7280);
            color: #fff;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            text-align: center;
            padding: 50px 0;
            animation: fadeIn 2s ease-in;
        }
        h1 {
            font-size: 3em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .destinations {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .destination-card {
            background: #fff;
            color: #333;
            width: 300px;
            margin: 20px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        }
        .destination-card:hover {
            transform: scale(1.05);
        }
        .destination-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .destination-card h3 {
            padding: 10px;
            margin: 0;
        }
        .destination-card p {
            padding: 0 10px 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #ff6f61;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #e55a50;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Theretowhere</h1>
        <p>Discover Your Next Adventure</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php" class="btn">Go to Dashboard</a>
            <a href="logout.php" class="btn">Logout</a>
        <?php else: ?>
            <a href="signup.php" class="btn">Sign Up</a>
            <a href="login.php" class="btn">Login</a>
        <?php endif; ?>
    </header>
    <div class="container">
        <h2>Trending Destinations</h2>
        <div class="destinations">
            <div class="destination-card">
                <img src="https://via.placeholder.com/300x200?text=Paris" alt="Paris">
                <h3>Paris, France</h3>
                <p>Explore the city of love with iconic landmarks.</p>
                <a href="search.php" class="btn">Book Now</a>
            </div>
            <div class="destination-card">
                <img src="https://via.placeholder.com/300x200?text=Tokyo" alt="Tokyo">
                <h3>Tokyo, Japan</h3>
                <p>Experience vibrant culture and modern wonders.</p>
                <a href="search.php" class="btn">Book Now</a>
            </div>
        </div>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
