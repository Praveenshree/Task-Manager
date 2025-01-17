<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "task_manager"; // The database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all tasks from the database
$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Link to External CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Task Manager</h1>

        <!-- Form to Add a New Task -->
        <form action="add_task.php" method="POST">
            <label for="task_name">Task Name:</label>
            <input type="text" id="task_name" name="task_name" required>
            <button type="submit">Add Task</button>
        </form>

        <h2>Task List</h2>
        <ul>
            <?php
            // Display all tasks
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $completedClass = $row['completed'] ? 'completed' : '';
                    echo "<li class='$completedClass'>";
                    echo $row['task_name'];
                    if ($row['completed']) {
                        echo " (Completed)";
                    } else {
                        echo " <a href='update_task.php?id=" . $row['id'] . "'>Mark as Completed</a>";
                    }
                    echo " <a href='delete_task.php?id=" . $row['id'] . "'>Delete</a>";
                    echo "</li>";
                }
            } else {
                echo "<li>No tasks found</li>";
            }

            $conn->close();
            ?>
        </ul>
    </div>

    <footer>
        <p>&copy; 2025 Task Manager. All rights reserved.</p>
    </footer>

</body>
</html>
