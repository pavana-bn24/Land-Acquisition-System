<?php
include "db_connect.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Run only when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $contact = $_POST['contact'];

    // Check if username already exists
    $check = $conn->prepare("SELECT * FROM buyers WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<h3 style='color:red;'>Username already exists. Please choose a different username.</h3>";
        echo "<a href='profile.html'>Go back to Signup</a>";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert all data
    $stmt = $conn->prepare("INSERT INTO buyers (username, password, email, first_name, last_name, address, city, state, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $username, $hashed_password, $email, $first_name, $last_name, $address, $city, $state, $contact);

    if ($stmt->execute()) {
        header("Location: thankyou.html");
        exit();
    } else {
        echo "<h3 style='color:red;'>Error creating account. Please try again.</h3>";
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>