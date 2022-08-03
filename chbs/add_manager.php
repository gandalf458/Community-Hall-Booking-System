<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name  = clean_str($_POST['name']);
  $phone = clean_str($_POST['phone']);
  $email = clean_str($_POST['email']);

  $q = 'INSERT INTO manager (name, phone, email) VALUES (:name, :phone, :email)';
  $data = ['name' => $name, 'phone' => $phone, 'email' => $email];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Manager Added Successfully.');
  }
}

?>
<h2>Add Manager</h2>
  <form method="post">
    <div class="form-group">
      <label for="name">Manager Name</label>
      <input type="text" name="name" required class="form-control" id="name" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" required class="form-control" id="phone" placeholder="Enter Phone">
    </div>
     <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" required class="form-control" id="email" placeholder="Enter Email">
    </div>
    <button type="submit" name="add" class="btn btn-primary">Submit</button>
  </form>

<?php
include 'inc/footer.inc.php';
