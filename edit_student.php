<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Details</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
    <?php
    session_start();

    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    require_once 'db_connection.php';

    // Check if the student ID is provided in the URL
    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    $student_id = $_GET['id'];

    // Query to fetch the student's information
    $query = "SELECT * FROM students WHERE id = $student_id";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);

    // Check if the student exists in the database
    if (!$student) {
        echo "Student not found.";
        exit();
    }

    // Handle form submission when the user updates student details
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];
        $school_roll_no = $_POST["school_roll_no"];
        $email = $_POST["email"];
        $phone_no = $_POST["phone_no"];
        $date_of_birth = $_POST["date_of_birth"];

        // Perform the update query
        $update_query = "UPDATE students SET full_name='$name', roll_no='$school_roll_no', email='$email', phone_no='$phone_no', date_of_birth='$date_of_birth' WHERE id=$student_id";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            echo "<p>Student details updated successfully!</p>";
            header('Location: index.php'); // Redirect to the dashboard
            exit();
        } else {
            echo "<p>Error updating student details. Please try again.</p>";
        }
    }
    ?>

    <div class="header">
        <h1>Edit Student Details</h1>
    </div>
    <div class="content">
        <div class="edit-student-form">
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $student['full_name']; ?>" required><br>

                <label for="school_roll_no">School Roll No:</label>
                <input type="text" name="school_roll_no" value="<?php echo $student['roll_no']; ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>

                <label for="phone_no">Phone No:</label>
                <input type="text" name="phone_no" value="<?php echo $student['phone_no']; ?>" required><br>

                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth" value="<?php echo $student['date_of_birth']; ?>" required><br>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
    <div class="footer">
        <p>© <?php echo date('Y'); ?> School Web Application. All rights reserved.</p>
    </div>
</body>
</html>
