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

if ($result->num_rows > 0) {
    echo "<h3>✅ You have already voted.</h3>";
    exit();
}

// Get candidates
$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 40px; }
        .card { background: #fff; padding: 20px; margin: auto; max-width: 400px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        button { padding: 10px 20px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Vote for your candidate</h2>
        <form method="POST" action="submit_vote.php">
            <?php while ($row = $candidates->fetch_assoc()): ?>
                <div>
                    <input type="radio" name="candidate_id" value="<?= $row['id'] ?>" required>
                    <?= htmlspecialchars($row['name']) ?>
                </div>
            <?php endwhile; ?>
            <button type="submit">Submit Vote</button>
        </form>
    </div>
</body>
</html>
