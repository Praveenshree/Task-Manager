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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_name'])) {
    // Sanitize input
    $task_name = mysqli_real_escape_string($conn, trim($_POST['task_name']));

    // Insert the task into the database
    $sql = "INSERT INTO tasks (task_name) VALUES ('$task_name')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the index page
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
