<?php include 'inc/header.inc.php'; ?>
<!--
<h2>Find Client</h2>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" name="client_id" placeholder="Enter Client ID" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Submit</button>
  </form>
  <br>
  <br>
  <br>
-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $client_id = clean_str($_POST['client_id']);
  $name      = clean_str($_POST['name']);
  $phone     = clean_str($_POST['phone']);
  $address   = clean_str($_POST['address']);
  $email     = clean_str($_POST['email']);

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

  <h2>Edit Client ID: <?=$client_id?></h2>
  <form method="post" action="edit_client.php">
    <input type="hidden" name="client_id" value="<?=$client_id?>">
    <div class="form-group">
      <label for="name">Client Name</label>
      <input type="text" name="name" value="<?=$name?>" required class="form-control" id="name" placeholder="Enter Name">
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
