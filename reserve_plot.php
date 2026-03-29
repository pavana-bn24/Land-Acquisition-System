<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $plot_number = $_POST['plot_number'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Check if plot exists and is available
    $stmt = $conn->prepare("SELECT id, status FROM plots WHERE plot_number = ?");
    $stmt->bind_param("i", $plot_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "❌ Plot does not exist.";
        exit();
    }

    $stmt->bind_result($plot_id, $status);
    $stmt->fetch();

    if ($status !== 'available') {
        echo "❌ Plot is already $status.";
        exit();
    }

    // Reserve the plot
    $stmt = $conn->prepare("UPDATE plots SET status = 'reserved' WHERE id = ?");
    $stmt->bind_param("i", $plot_id);
    $stmt->execute();

    // Save reservation details
    $stmt = $conn->prepare("INSERT INTO reservations (plot_id, name, email, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $plot_id, $name, $email, $contact);
    $stmt->execute();

    // Show confirmation popup with redirection button
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Reservation Success</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f1f1f1;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .popup {
                background-color: #fff;
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 0 10px rgba(0,0,0,0.2);
                text-align: center;
                max-width: 400px;
            }
            .popup h2 {
                color: green;
            }
            .popup p {
                margin: 15px 0;
                line-height: 1.6;
            }
            .popup button {
                padding: 10px 20px;
                background-color: green;
                color: white;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-size: 16px;
            }
            .popup button:hover {
                background-color: darkgreen;
            }
        </style>
    </head>
    <body>
        <div class='popup'>
            <h2>✅ Plot Reserved Successfully!</h2>
            <p>Your plot has been successfully reserved.<br>
            For further details, please contact us and visit our office.<br>
            You may proceed with the transaction if you like the plot.</p>
            <button onclick=\"window.location.href='plotlayoutt.php'\">OK</button>
        </div>
    </body>
    </html>
    ";
    exit();
}
?>
