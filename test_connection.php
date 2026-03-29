<?php
include 'db_connect.php'; // Include the database connection file

if ($conn) {
    echo "Connected successfully to the database!";
} else {
    echo "Failed to connect to the database.";
}
?>
