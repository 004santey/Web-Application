<!DOCTYPE html>
<html>
<head>
    <title>Setting</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    session_start();

    // Check if the user is not logged in or not an admin, redirect to login page
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: login.php');
        exit();
    }

    // Handle dark mode switch
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['dark_mode'])) {
        $dark_mode = $_POST['dark_mode'] === 'on' ? 1 : 0;

        // Update dark mode setting in the database or session, depending on your implementation
        // Example: $_SESSION['dark_mode'] = $dark_mode;
        // Example: Update database using an SQL query
    }
    ?>

    <div class="sidebar">
        <h2>School Web App</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="student.php?students=true">Student</a></li>
            <li><a href="teacher.php?teachers=true">Teacher</a></li>
            <li><a href="setting.php">Setting</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Setting</h1>
        </div>
        <div class="form-container">
            <form method="post">
                <div class="form-group">
                    <label for="dark_mode">Dark Mode:</label>
                    <input type="checkbox" name="dark_mode" id="dark_mode" <?php echo isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'checked' : ''; ?>>
                </div>
                <div class="form-group">
                    <input type="submit" value="Save Settings">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
