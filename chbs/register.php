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
    require_once 'inc/functions.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $pdo = new PDO('sqlite:chbs.sqlite');
      if (!$pdo)
        echo 'Connection Error';

      $username = clean_str($_POST['username']);
      $password = password_hash(clean_str($_POST['password']), PASSWORD_DEFAULT);
      $type     = 'admin';

      $q = 'INSERT INTO users (username, password, type) VALUES (:username, :password, :type)';
      $data = ['username' => $username, 'password' => $password, 'type' => $type];
      $stmt = $pdo->prepare($q);
      $stmt->execute($data);

      if (!$stmt){
        dangerMsg('An error occurred  ');
      }  else {
        successMsg('Inserted Successfully');
      }

    }
    ?>

    <form method="post">
      <h1>Register New User</h1>
      <div class="form-group">
        <label for="username">Username</label>    
        <input type="text" name="username" class="form-control" autocomplete="off" required placeholder="Enter the user's name">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" autocomplete="off" required placeholder="Enter password">
      </div>
      <button class="btn btn-primary" type="submit" name="register">Register</button>
    </form>
  </div>
</main>  
</body>
</html>
