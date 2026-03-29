<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plot_id = $_POST['plot_id']; // you're sending plot_id from the form

    // Delete reservation using plot_id (not plot_number)
    $delete_reservation = "DELETE FROM reservations WHERE plot_id = '$plot_id'";
    mysqli_query($conn, $delete_reservation);

    // Update plot status to 'Available' in plots table
    $update_plot = "UPDATE plots SET status = 'Available' WHERE id = '$plot_id'";
    mysqli_query($conn, $update_plot);

    // Redirect back to admin dashboard
    header("Location: admin_dashboard.php");
    exit();
}
?>
