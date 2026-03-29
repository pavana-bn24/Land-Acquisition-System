<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "land_management_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and password from login form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare statement to fetch user by email
$stmt = $conn->prepare("SELECT * FROM buyers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user with the given email exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password using password_verify
    if (password_verify($password, $user['password'])) {
        // ✅ Password is correct, login successful
        header("Location: thankyou.html");
        exit();
    } else {
        // ❌ Password is incorrect
        echo "<h3 style='color:red;'>Invalid password. Please try again.</h3>";
    }
} else {
    // ❌ Email not found
    echo "<h3 style='color:red;'>Email not found. Please sign up first.</h3>";
}

$conn->close();
?>
