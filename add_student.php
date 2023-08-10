<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="CSS/add_student.css">
</head>
<body>
    <?php
    session_start();

    // Check if the user is not logged in or not an admin, redirect to login page
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php');
        exit();
    }

    require_once 'db_connection.php';

    // Variables to hold form data
    $full_name = $roll_no = $email = $phone_no = $date_of_birth = '';
    $password_error = '';

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $full_name = $_POST['full_name'];
        $roll_no = $_POST['roll_no'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $date_of_birth = $_POST['date_of_birth'];

        // Validate and insert student data into the database
        $insert_query = "INSERT INTO students (full_name, roll_no, email, phone_no, date_of_birth) VALUES ('$full_name', '$roll_no', '$email', '$phone_no', '$date_of_birth')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            // Student added successfully
            header('Location: student.php?students=true');
            exit();
        } else {
            // Database insertion failed
            $password_error = 'Error: Failed to insert student into the database.';
        }
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
            <h1>Add Student</h1>
        </div>
        <div class="form-container">
            <form method="post">
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" required value="<?php echo $full_name; ?>">
                </div>
                <div class="form-group">
                    <label for="roll_no">School Roll No:</label>
                    <input type="text" name="roll_no" id="roll_no" required value="<?php echo $roll_no; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone No:</label>
                    <input type="text" name="phone_no" id="phone_no" required value="<?php echo $phone_no; ?>">
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" required value="<?php echo $date_of_birth; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Student">
                </div>
            </form>
            <?php if ($password_error) { ?>
                <p class="error"><?php echo $password_error; ?></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
