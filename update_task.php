<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_manager";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Mark the task as completed (set `completed` to 1)
    $sql = "UPDATE tasks SET completed = 1 WHERE id = $task_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the main page
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
