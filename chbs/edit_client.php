<?php include 'inc/header.inc.php'; ?>

<h2>Find Client</h2>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" name="client_id" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br>
  <br>
  <br>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $client_id = $_POST['client_id'];
  $name      = $_POST['name'];
  $phone     = $_POST['phone'];
  $address   = $_POST['address'];
  $email     = $_POST['email'];

  $q = 'UPDATE client SET name=:name, phone=:phone, address=:address, email=:email WHERE client_id = :client_id';
  $data = ['name' => $name, 'phone' => $phone, 'address' => $address, 'email' => $email, 'client_id' => $client_id];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Client Updated Successfully.');
  }
}

if (isset($_GET['client_id'])) {

  $client_id = $_GET['client_id'];

  $q = "SELECT * FROM client where client_id = ?";
  $stmt = $pdo->prepare($q);
  $stmt->execute([$client_id]);
  $client = $stmt->fetch();
  if ($client) {
    $name    = $client['name'];
    $phone   = $client['phone'];
    $address = $client['address'];
    $email   = $client['email'];
?>

  <h3>Edit Client ID: <?=$client_id?></h3>
  <form method="post" action="edit_client.php">
    <input type="hidden" name="client_id" value="<?=$client_id?>">
    <div class="form-group">
      <label for="name">Client Name</label>
      <input type="text" name="name" value="<?=$name?>" required class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" value="<?=$phone?>" required class="form-control" id="phone" placeholder="Enter Phone">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" value="<?=$address?>" required class="form-control" id="address" placeholder="Enter Phone">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" value="<?=$email?>" required class="form-control" id="email" placeholder="Enter Email">
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
  <?php
  } else {
    alertMsg('Client ID: <strong>'.$client_id.'</strong> Not Found.');
  }
}

include 'inc/footer.inc.php';
