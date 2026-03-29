<?php
session_start();

// Include your DB connection
include 'db_connect.php';

// Get email and password from form
$email = $_POST['email'];
$password = $_POST['password'];

// Validate inputs
if (empty($email) || empty($password)) {
    echo "Please enter both email and password.";
    exit();
}

// Check credentials
$sql = "SELECT * FROM buyers WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// If match found
if ($result->num_rows === 1) {
    $_SESSION['buyer_email'] = $email;

    // Redirect to thank you page
    header("Location: thankyou.html");
    exit();
} else {
    echo "<h3 style='color:red; text-align:center;'>Invalid email or password.</h3>";
}

$conn->close();
?>
