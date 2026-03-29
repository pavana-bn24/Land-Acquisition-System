<?php
include 'db_connect.php'; // Assumes your DB connection file

// Fetch all reservations
$sql = "SELECT * FROM reservations";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Buyers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f0f0f0;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #444;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
        .remove-button {
            padding: 6px 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .remove-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Buyer Reservations</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Plot ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Reserved At</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['plot_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['reserved_at']; ?></td>
            <td>
                <form method="POST" action="delete_reservation.php" onsubmit="return confirm('Are you sure you want to remove this reservation?');">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="remove-button">Remove</button>
                </form>
            </td>
        </tr>
        <?php } ?>

    </table>
</body>
</html>
