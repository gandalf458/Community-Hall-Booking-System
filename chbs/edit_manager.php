<?php include 'inc/header.inc.php'; ?>

<h2>Find Manager</h2>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" name="manager_id" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br>
  <br>
  <br>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $manager_id = $_POST['manager_id'];
  $name       = $_POST['name'];
  $phone      = $_POST['phone'];
  $email      = $_POST['email'];

  $q = 'UPDATE manager SET name=:name, phone=:phone, email=:email WHERE manager_id = :manager_id';
  $data = ['name' => $name, 'phone' => $phone, 'email' => $email, 'manager_id' => $manager_id];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Manager Updated Successfully.');
  }
}

if (isset($_GET['manager_id']) ){

  $manager_id = $_GET['manager_id'];

  $q = 'SELECT name, phone, email FROM manager where manager_id = ?';
  $stmt = $pdo->prepare($q);
  $stmt->execute([$manager_id]);
  $manager = $stmt->fetch();
  if ($manager) {
    $name  = $manager['name'];
    $phone = $manager['phone'];
    $email = $manager['email'];
?>

  <h3>Edit Manager ID: <?=$manager_id?></h3>
  <form method="post" action="edit_manager.php">
    <input type="hidden" name="manager_id" value="<?=$manager_id?>">
    <div class="form-group">
      <label for="name">Manager Name</label>
      <input type="text" name="name" value="<?=$name?>" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" value="<?=$phone?>" required class="form-control" id="phone" placeholder="Enter Phone">
    </div>
     <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" value="<?=$email?>" required class="form-control" id="email" placeholder="Enter Email">
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
  <?php
  } else {
    alertMsg('Manager ID: <strong>'.$manager_id.'</strong> Not Found.');
  }
}

include 'inc/footer.inc.php';
