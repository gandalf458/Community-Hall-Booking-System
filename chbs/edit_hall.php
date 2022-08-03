<?php include 'inc/header.inc.php'; ?>
<!--
<h2>Find Hall</h2>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" name="hall_id" placeholder="Enter Hall ID" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Submit</button>
  </form>
  <br>
  <br>
  <br>
-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $hall_id    = clean_str($_POST['hall_id']);
  $name       = clean_str($_POST['name']);
  $phone      = clean_str($_POST['phone']);
  $address    = clean_str($_POST['address']);
  $rent       = clean_str($_POST['rent']);
  $size       = clean_str($_POST['size']);
  $manager_id = clean_str($_POST['manager_id']);

  $q = 'UPDATE hall SET name=:name, phone=:phone, address=:address, rent=:rent, size=:size, manager_id=:manager_id WHERE hall_id = :hall_id';
  $data = ['hall_id' => $hall_id, 'name' => $name, 'phone' => $phone, 'address' => $address, 'rent' => $rent, 'size' => $size, 'manager_id' => $manager_id];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Hall Updated Successfully.');
  }
}

if (isset($_GET['hall_id'])) {

  $hall_id = $_GET['hall_id'];

  $q = "SELECT * FROM hall where hall_id = ?";
  $stmt = $pdo->prepare($q);
  $stmt->execute([$hall_id]);
  $hall = $stmt->fetch();
  if ($hall) {
    $name       = $hall['name'];
    $phone      = $hall['phone'];
    $address    = $hall['address'];
    $rent       = $hall['rent'];
    $size       = $hall['size'];
    $manager_id = $hall['manager_id'];
?>

  <h2>Edit hall ID: <?=$hall_id?></h2>
  <form method="post" action="edit_hall.php">
    <input type="hidden" name="hall_id" value="<?=$hall_id?>">
    <div class="form-group">
      <label for="name">Hall Name</label>
      <input type="text" name="name" value="<?=$name?>" required class="form-control" id="name">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" value="<?=$phone?>" required class="form-control" id="phone">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" value="<?=$address?>" required class="form-control" id="address">
    </div>
    <div class="form-group">
      <label for="rent">Rent</label>
      <input type="text" name="rent" value="<?=$rent?>" required class="form-control" id="rent">
    </div>
    <div class="form-group">
      <label for="size">Size</label>
      <input type="text" name="size" value="<?=$size?>" required class="form-control" id="size">
    </div>
    <div class="form-group">
      <label for="manager">Manager</label>
      <select name="manager_id" required class="form-control" id="manager">
        <option value="<?=$manager_id?>" selected><?=getManager($manager_id)['name']?></option>
      <?php
      $q = 'SELECT manager_id, name FROM manager';
      $rows = $pdo->query($q);
      foreach ($rows as $r) {
      ?>
        <option value="<?=$r['manager_id']?>"><?=$r['name']?></option>
      <?php
      }
      ?>
      </select>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
  <?php
  } else {
    alertMsg('Hall ID: <strong>'.$hall_id.'</strong> Not Found.');
  }
}

include 'inc/footer.inc.php';
