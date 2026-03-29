<?php
include 'db_connect.php';

// Fetch plot data from the database
$result = $conn->query("SELECT plot_number, status FROM plots");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link rel="stylesheet" href="plotlayoutt.css" />

</head>
<body>

    <header>
        <div class="logo">🌐 SAM</div>
        <nav>
          <a href="index.html">Home</a>
          <a href="about.html" class="active">About Us</a>
          <a href="amenities.html">Amenities</a>
          
        </nav>
    </header>

  <main>
    <h1 class="dashboard-title">RathnaShree Layout</h1>

    <section class="plot-layout">
      <img src="images/layoutdesign.png" alt="Plot Layout" />
    </section>

    <section class="plot-status">
      <h2>Current Plot Status:</h2>
      <div class="plots">
        <?php
        // Loop through all plots from 1 to 20
        for ($i = 1; $i <= 20; $i++) {
            // Fetch plot status from the database
            $plot_status = 'available'; // Default status if not set in DB
            
            // Check if plot data exists for current plot number
            while ($row = $result->fetch_assoc()) {
                if ($row['plot_number'] == $i) {
                    $plot_status = $row['status']; // Set the actual plot status (Available, Reserved, Sold)
                    break;
                }
            }
        ?>
            <button class="<?php echo $plot_status; ?>" data-plot="<?php echo $i; ?>">
                Plot <?php echo $i; ?>
            </button>
        <?php } ?>
      </div>
    </section>

    <section class="chart-sheet">
        <h2>Chart Sheet:</h2>
      
        <div class="legend status-legend">
          <div class="status-box available">Available</div>
          <div class="status-box reserved">Reserved</div>
          <div class="status-box sold">Sold</div>
        </div>
      
        
      </section>
      
    <section class="reservation">
      <h2>For Reservation</h2>
      <p>Choose your Plot number here!!</p>
      <form action="reserve_plot.php" method="POST">
        <label>Plot
          <input type="number" name="plot_number" min="1" max="20" required />
        </label>
        <label>Name
          <input type="text" name="name" required />
        </label>
        <label>Email
          <input type="email" name="email" required />
        </label>
        <label>Contact
          <input type="text" name="contact" required />
        </label>
        <button type="submit" class="reserve-btn">Reserve</button>
      </form>
    </section>


    

  <footer>
    <p>CONTACT US THROUGH</p>
    <div class="social-icons">
      <img src="images/facebook.png.png" alt="Facebook">
      <img src="images/instagram.png.png" alt="Instagram">
      <img src="images/youtube.png.png" alt="YouTube">
    </div>
  </footer>

</body>
</html>
