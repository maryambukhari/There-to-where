<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first!'); redirectTo('login.php');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book'])) {
    $destination = $_POST['destination'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $travel_type = $_POST['travel_type'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO trips (user_id, destination, price, duration, travel_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $destination, $price, $duration, $travel_type]);
    // Simulate email confirmation
    echo "<script>alert('Trip booked successfully! Confirmation sent to your email.');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Trips - Theretowhere</title>
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
        .search-form {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease;
        }
        input, select {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background: #ff6f61;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #e55a50;
        }
        .trip-results {
            display: flex;
            flex-wrap: wrap;
        }
        .trip-card {
            background: #fff;
            color: #333;
            width: 300px;
            margin: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        }
        .trip-card:hover {
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Trips</h2>
        <form class="search-form" method="GET">
            <input type="text" name="destination" placeholder="Destination">
            <input type="number" name="price" placeholder="Max Price">
            <select name="travel_type">
                <option value="">Select Travel Type</option>
                <option value="flight">Flight</option>
                <option value="hotel">Hotel</option>
                <option value="package">Package</option>
            </select>
            <button type="submit" class="btn">Search</button>
        </form>
        <div class="trip-results">
            <?php
            // Sample trip data (replace with DB query for production)
            $trips = [
                ['destination' => 'Paris', 'price' => 500, 'duration' => 7, 'travel_type' => 'package'],
                ['destination' => 'Tokyo', 'price' => 800, 'duration' => 5, 'travel_type' => 'flight']
            ];
            foreach ($trips as $trip):
            ?>
                <div class="trip-card">
                    <h3><?php echo $trip['destination']; ?></h3>
                    <p>Price: $<?php echo $trip['price']; ?></p>
                    <p>Duration: <?php echo $trip['duration']; ?> days</p>
                    <p>Type: <?php echo $trip['travel_type']; ?></p>
                    <form method="POST">
                        <input type="hidden" name="destination" value="<?php echo $trip['destination']; ?>">
                        <input type="hidden" name="price" value="<?php echo $trip['price']; ?>">
                        <input type="hidden" name="duration" value="<?php echo $trip['duration']; ?>">
                        <input type="hidden" name="travel_type" value="<?php echo $trip['travel_type']; ?>">
                        <button type="submit" name="book" class="btn">Book Now</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
