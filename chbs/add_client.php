<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name    = $_POST['name'];
  $phone   = $_POST['phone'];
  $address = $_POST['address'];
  $email   = $_POST['email'];

  $q = 'INSERT INTO client (name, phone, address, email) VALUES (:name, :phone, :address, :email);';
  $data = ['name' => $name, 'phone' => $phone, 'address' => $address, 'email' => $email];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Client Added Successfully.');
  }
}

?>
<h2>Add Client</h2>
  <form method="post">
    <div class="form-group">
      <label for="name">Client Name</label>
      <input type="text" name="name" required class="form-control" id="name" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" required class="form-control" id="address" aria-describedby="addHelp" placeholder="Enter Address">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" required class="form-control" id="phone" placeholder="Enter Phone">
    </div>
    <div class="form-group">
      <label for="pass">Email</label>
      <input type="text" name="email" required class="form-control" id="pass" placeholder="Enter Email">
    </div>
    <button type="submit" name="add" class="btn btn-primary">Submit</button>
  </form>

<?php
include 'inc/footer.inc.php';
