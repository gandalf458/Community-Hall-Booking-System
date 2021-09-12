<?php
// needs work
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pdo = new PDO('sqlite:chbs.sqlite');
  if (!$pdo)
    echo 'Connection Error';

  $username = $_POST['username'];
  $password = $_POST['password'];
  $type     = 'admin';

  $q = 'INSERT INTO users (username, password, type) VALUES (:username, :password, :type)';
  $data = ['username' => $username, 'password' => $password, 'type' => $type];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

#  $result = mysqli_query($pdo,"INSERT INTO client(client_id,name,phone,address,email) VALUES(NULL,'{$name}', '{$phone}', '{$add}', '{$email}')");

  if (!$stmt){
    echo '<p>An error occurred.</p>';
  }  else {
    echo '<p class="msg">Inserted Successfully</p>';
  }

}
?>

  <form method="post">
    <h1>Register</h1>
    <p>
      <label for="username">Name</label>    
      <input type="text" name="username" placeholder="Enter the user's name">
    </p>
    <p>
      <label for="password">Phone</label>
      <input type="text" name="password" placeholder="Enter password">
    </p>
    <p>
      <input class="btn" type="submit" name="register" value="Register">
    </p>
  </form>
    
<?php
include 'inc/footer.inc.php';
