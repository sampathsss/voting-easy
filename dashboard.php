<?php
session_start();
include('db.php');

if (!isset($_SESSION['userdata'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['userdata'];

// Fetch all candidates
$candidates = mysqli_query($conn, "SELECT * FROM userdata WHERE standard='candidate'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $user['username']; ?>!</h2>
        <p style="text-align:center; margin-bottom: 20px;">
            You are logged in as: <strong><?php echo $user['standard']; ?></strong>
        </p>

        <h3>Select a Candidate:</h3>
        <form method="POST" action="vote.php">
            <?php while ($row = mysqli_fetch_array($candidates)) { ?>
                <div class="candidate">
                    <span><?php echo $row['username']; ?></span>
                    <input type="radio" class="radio" name="candidate_id" value="<?php echo $row['id']; ?>" required>
                </div>
            <?php } ?>
            <button type="submit">Vote</button>
        </form>
    </div>
</body>
</html>
