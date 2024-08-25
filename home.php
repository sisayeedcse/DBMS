<!-- home.php -->
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'student_info');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the email and password from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch the student's information from the database using email
$sql = "SELECT * FROM students WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $row['password'])) {
        // Display student information
        echo "<h2>Welcome, " . $row["name"] . "</h2>";
        echo "<p>ID Number: " . $row["id_number"] . "</p>";
        echo "<p>Semester: " . $row["semester"] . "</p>";
        echo "<p>Department: " . $row["department"] . "</p>";
        echo "<p>Phone Number: " . $row["phone_number"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No student found with this email.";
}

$conn->close();
?>
