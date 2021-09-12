<?php
ob_start();
require_once 'inc/functions.php';

$username = '';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST["username"];
  $password = ($_POST["password"]);
  $q = 'SELECT * FROM users WHERE username = ? AND password = ?';
  $stmt = $pdo->prepare($q);
  $stmt->execute([$username, $password]);
  $row = $stmt->fetch();

    if ($row) {
      // Success
      // Mark user as logged in
      if ($row['type'] == 'admin')
        setcookie('admin', true, time()+60*60*24*7);
      setcookie('username', $username, time()+60*60*24*7);
      setcookie('loggedin', $username, time()+60*60*24*7);
      header('Location: index.php');
      exit;
    } else {
      // Failure
      $msg = "Invalid Login.";
    }
  }

?>
<!DOCTYPE html>
<html lang="EN">
<head>
<title>Community Hall Booking System</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<main role="main" class="container">
  <div class="login-area">
    <?php
    if ($msg != '') {
      dangerMsg($msg);
    }
    ?>
    <form method="post" class="form-signin">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="username" name="username" class="form-control" autocomplete="off" required id="username" placeholder="Username">
        </div>
      <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" name="password" class="form-control" autocomplete="off" required id="pass" placeholder="Password">
      </div>
      <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
  </div>
</main>
</body>
</html>
