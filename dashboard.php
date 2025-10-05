<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first!'); redirectTo('login.php');</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_review'])) {
    $trip_id = $_POST['trip_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $stmt = $pdo->prepare("INSERT INTO reviews (user_id, trip_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $trip_id, $rating, $comment]);
    echo "<script>alert('Review submitted!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Theretowhere</title>
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
        .section {
            background: #fff;
            color: #333;
            padding: 20px;
            margin: 20px 0;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease;
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
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Dashboard</h2>
        <div class="section">
            <h3>Your Trips</h3>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM trips WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $trips = $stmt->fetchAll();
            foreach ($trips as $trip):
            ?>
                <div>
                    <p><?php echo $trip['destination']; ?> - $<?php echo $trip['price']; ?> (<?php echo $trip['duration']; ?> days)</p>
                    <form method="POST">
                        <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">
                        <select name="rating" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                        <input type="text" name="comment" placeholder="Your review">
                        <button type="submit" name="submit_review" class="btn">Submit Review</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="section">
            <h3>Saved Destinations</h3>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM saved_destinations WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $destinations = $stmt->fetchAll();
            foreach ($destinations as $destination):
            ?>
                <p><?php echo $destination['destination']; ?></p>
            <?php endforeach; ?>
        </div>
        <a href="index.php" class="btn">Back to Home</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
