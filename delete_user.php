<?php
include './includes/db.php';

if (isset($_GET['delete_user_id'])) {
    $id = $_GET['delete_user_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `users` WHERE id=?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo '<script>alert("User Deleted");</script>';
        header("Location: user.php");
        exit(); // It's good practice to use exit() after header redirects
    } else {
        echo '<script>alert("Failed to delete users");</script>';
        // Do not redirect if you want to show the alert
    }
    
    $stmt->close();
}

$conn->close();
?>
