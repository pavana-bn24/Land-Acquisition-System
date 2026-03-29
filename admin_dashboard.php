<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <div class="logo">Villa Plots Admin</div>
        <ul class="nav-links">
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="admin_logout.php" style="color: red; font-weight: bold;">Logout</a></li>
        </ul>
    </div>

    <h1 class="center">Admin Dashboard - Manage Plots</h1>


    




<form action="generate_report.php" method="post" style="text-align: center; margin-top: 20px;">
    <button type="submit" class="btn-print">Generate Buyer Report</button>
</form>








    <div class="dashboard-container">
        <?php
        include 'db_connect.php';

        // Fetch all plots and join reservation info
        $query = "SELECT plots.id AS plot_id, plots.plot_number, plots.status, 
                         reservations.name AS reserved_by
                  FROM plots
                  LEFT JOIN reservations ON plots.id = reservations.plot_id
                  ORDER BY plots.plot_number ASC";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Plot Number</th>
                        <th>Status</th>
                        <th>Reserved By</th>
                        <th>Change Status</th>
                        <th>Remove Reservation</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['plot_number']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>" . ($row['reserved_by'] ?? '-') . "</td>
                        <td>
                            <form action='update_plot_status.php' method='POST'>
                                <input type='hidden' name='plot_id' value='" . $row['plot_id'] . "'>
                                <select name='new_status'>
                                    <option value='Available'" . ($row['status'] == 'Available' ? ' selected' : '') . ">Available</option>
                                    <option value='Reserved'" . ($row['status'] == 'Reserved' ? ' selected' : '') . ">Reserved</option>
                                    <option value='Sold'" . ($row['status'] == 'Sold' ? ' selected' : '') . ">Sold</option>
                                </select>
                                <button type='submit'>Update</button>
                            </form>
                        </td>
                        <td>
                            <form action='remove_buyer.php' method='POST' onsubmit='return confirm(\"Are you sure you want to remove the buyer from this plot?\")'>
                                <input type='hidden' name='plot_id' value='" . $row['plot_id'] . "'>
                                <button type='submit'>Remove</button>
                            </form>
                        </td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No plots found.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2025 Villa Plots Admin Dashboard</p>
    </footer>
</body>
</html>
