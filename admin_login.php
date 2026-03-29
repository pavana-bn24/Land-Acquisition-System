<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin.css">


</head>
<body>
  <div class="admin-login">
    <div class="admin-login-box">
  <h2>Admin Login</h2>
  <form action="process_admin_login.php" method="POST">
    <input type="text" name="username" placeholder="Enter Admin Username" required><br>
    <input type="password" name="password" placeholder="Enter Password" required><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
