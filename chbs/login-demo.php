<?php
ob_start();
require_once 'inc/functions.php';

$username = '';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = clean_str($_POST["username"]);
  $password = clean_str($_POST["password"]);
  $query = 'SELECT username, password, type FROM users WHERE username = :username';
  $stmt = $pdo->prepare($query);
  $stmt->bindParam('username', $_POST['username'], PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch();

  if ($row) {
    if (password_verify($_POST['password'], $row['password'])) {
      $_SESSION['username'] = $_POST['username'];
      if ($row['type'] == 'admin')
        setcookie('admin', true, time()+60*60*24*7);
      setcookie('username', $username, time()+60*60*24*7);
      setcookie('loggedin', $username, time()+60*60*24*7);
      header('Location: index.php');
      exit;
    }
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
      <h1>Log In</h2>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" autocomplete="off" required id="username" placeholder="Username">
        </div>
      <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" name="password" class="form-control" autocomplete="off" required id="pass" placeholder="Password">
      </div>
      <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
    <p>To log in to the demo system use username / password admin / admin</p>
  </div>
</main>
</body>
</html>
