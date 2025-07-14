<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'candidate') {
    header("Location: index.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "voting_db");

$results = $conn->query("
    SELECT c.name, COUNT(v.id) AS votes
    FROM candidates c
    LEFT JOIN votes v ON c.id = v.candidate_id
    GROUP BY c.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Vote Results</h2>
        <table>
            <tr><th>Candidate</th><th>Votes</th></tr>
            <?php while ($row = $results->fetch_assoc()): ?>
                <tr><td><?= $row['name'] ?></td><td><?= $row['votes'] ?></td></tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php">Logout</a>
    </div>
</body>
</html>
