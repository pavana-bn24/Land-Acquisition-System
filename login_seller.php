<?php
include("db_connect.php");
session_start();

$name = $_POST['name'];
$password = $_POST['password'];

$query = "SELECT * FROM seller WHERE name='$name' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['seller'] = $name;
    header("Location: plotsell.html"); // or .php
    exit();
} else {
    echo "Invalid credentials for seller.";
}
?>
