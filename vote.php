<?php
session_start();
include("db.php");

if (!isset($_SESSION['userdata'])) {
    header("Location: login.php");
    exit();
}

$userdata = $_SESSION['userdata'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['candidate_id'])) {
        $candidate_id = $_POST['candidate_id'];
        
        // Give the vote to selected candidate
        mysqli_query($conn, "UPDATE userdata SET votes = votes + 1 WHERE id = '$candidate_id'");
        
        // Mark user as voted
        mysqli_query($conn, "UPDATE userdata SET status = 1 WHERE id = '{$userdata['id']}'");
        
        echo "<script>alert('Vote submitted successfully!'); window.location = 'vote.php';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid selection!');</script>";
    }
}

// Fetch candidates
$candidates = mysqli_query($conn, "SELECT * FROM userdata WHERE standard = 'candidate'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote</title>
</head>
<body>
<h2>Welcome, <?php echo $userdata['username']; ?> (<?php echo $userdata['standard']; ?>)</h2>

<?php if ($userdata['status'] == 1): ?>
    <p><strong>You have already voted. Thank you!</strong></p>
<?php else: ?>
    <form method="POST">
        <?php while ($row = mysqli_fetch_assoc($candidates)) { ?>
            <label>
                <input type="radio" name="candidate_id" value="<?php echo $row['id']; ?>" required>
                <?php echo $row['username']; ?>
            </label><br><br>
        <?php } ?>
        <input type="submit" value="Submit Vote">
    </form>
<?php endif; ?>
</body>
</html>
