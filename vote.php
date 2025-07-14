<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'voter') {
    header("Location: index.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "voting_db");

// Check if already voted
$user_id = $_SESSION['user_id'];
$check = $conn->query("SELECT * FROM votes WHERE voter_id = $user_id");
if ($check->num_rows > 0) {
    echo "<p>You have already voted.</p><a href='index.php'>Logout</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidate_id = $_POST['candidate'];
    $stmt = $conn->prepare("INSERT INTO votes (voter_id, candidate_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $candidate_id);
    $stmt->execute();
    echo "<p>Vote submitted successfully!</p><a href='index.php'>Logout</a>";
    exit;
}

// Get candidate list
$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Cast Your Vote</h2>
        <form method="POST">
            <?php while ($row = $candidates->fetch_assoc()): ?>
                <label><input type="radio" name="candidate" value="<?= $row['id'] ?>" required> <?= $row['name'] ?></label><br>
            <?php endwhile; ?>
            <button type="submit">Vote</button>
        </form>
    </div>
</body>
</html>
