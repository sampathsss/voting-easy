<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

// Check if user already voted
$check = $conn->prepare("SELECT * FROM votes WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$result = $check->get_result();
$voted = $result->num_rows > 0;

// Fetch candidates
$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 40px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            color: #333;
        }
        .candidate {
            margin-bottom: 10px;
        }
        button {
            margin-top: 10px;
            padding: 8px 16px;
        }
        .logout {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>

        <?php if ($voted): ?>
            <p>✅ You have already voted.</p>
        <?php else: ?>
            <form method="POST" action="submit_vote.php">
                <?php while ($row = $candidates->fetch_assoc()): ?>
                    <div class="candidate">
                        <input type="radio" name="candidate_id" value="<?= $row['id'] ?>" required>
                        <?= htmlspecialchars($row['name']) ?>
                    </div>
                <?php endwhile; ?>
                <button type="submit">Submit Vote</button>
            </form>
        <?php endif; ?>

        <div class="logout">
            <a href="logout.php">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
