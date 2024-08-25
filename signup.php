<!-- signup.php -->
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'student_info');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$id_number = $_POST['id_number'];
$semester = $_POST['semester'];
$department = $_POST['department'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if ID number already exists
$check_sql = "SELECT * FROM students WHERE id_number='$id_number'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "This ID number is already registered.";
} else {
    // Insert data into database
    $sql = "INSERT INTO students (name, id_number, semester, department, phone_number, email, password) 
            VALUES ('$name', '$id_number', '$semester', '$department', '$phone_number', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to avoid duplicate submissions on refresh
        header("Location: signup_success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
