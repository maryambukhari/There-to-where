<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first!'); redirectTo('login.php');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_destination'])) {
    $destination = $_POST['destination'];
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("INSERT INTO saved_destinations (user_id, destination) VALUES (?, ?)");
    $stmt->execute([$user_id, $destination]);
    echo "<script>alert('Destination saved!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Guides - Theretowhere</title>
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
        .blog-post {
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
        <h2>Travel Guides</h2>
        <?php
        // Sample blog data (replace with DB query)
        $posts = [
            ['title' => 'Exploring Paris', 'content' => 'Discover the charm of Paris...', 'destination' => 'Paris'],
            ['title' => 'Tokyo Adventures', 'content' => 'Experience Tokyo’s vibrant culture...', 'destination' => 'Tokyo']
        ];
        foreach ($posts as $post):
        ?>
            <div class="blog-post">
                <h3><?php echo $post['title']; ?></h3>
                <p><?php echo $post['content']; ?></p>
                <form method="POST">
                    <input type="hidden" name="destination" value="<?php echo $post['destination']; ?>">
                    <button type="submit" name="save_destination" class="btn">Save Destination</button>
                </form>
            </div>
        <?php endforeach; ?>
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
