```php
<?php
include 'db_connect.php';

// ✅ Correct query with proper joins
$query = "SELECT 
            p.plot_number, 
            CONCAT(b.first_name, ' ', b.last_name) AS buyer_name,
            b.email, 
            b.contact, 
            b.address, 
            b.city, 
            b.state, 
            r.reserved_at, 
            p.status
          FROM reservations r
          JOIN buyers b ON r.buyer_id = b.id
          JOIN plots p ON r.plot_id = p.id
          ORDER BY r.reserved_at DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyer Plot Reservation Report</title>
    <link rel="stylesheet" type="text/css" href="generate_report.css">
</head>
<body>
    <div class="report-container">
        <h1>Buyer Plot Reservation Report</h1>
        <p class="subtitle">Includes Reserved and Sold Plots</p>

        <div class="table-wrapper">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Plot Number</th>
                        <th>Buyer Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Reserved At</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['plot_number']}</td>
                                <td>{$row['buyer_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['state']}</td>
                                <td>{$row['reserved_at']}</td>
                                <td class='status'>{$row['status']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No reservations found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <button onclick="window.print()" class="print-btn">🖨️ Print Report</button>
    </div>
</body>
</html>
```
