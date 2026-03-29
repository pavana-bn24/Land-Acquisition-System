<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plot_id = $_POST['plot_id'];
    $new_status = $_POST['new_status'];

    // Update plot status
    $update_query = "UPDATE plots SET status = '$new_status' WHERE id = '$plot_id'";
    mysqli_query($conn, $update_query);

    // If set to Available, clear reservation
    if ($new_status === 'Available') {
        // Delete reservation
        $delete_query = "DELETE FROM reservations WHERE plot_id = '$plot_id'";
        mysqli_query($conn, $delete_query);
    }

    header("Location: admin_dashboard.php");
    exit();
}
?>
