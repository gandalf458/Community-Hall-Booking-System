<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name       = clean_str($_POST['name']);
  $phone      = clean_str($_POST['phone']);
  $address    = clean_str($_POST['address']);
  $rent       = clean_str($_POST['rent']);
  $manager_id = clean_str($_POST['manager_id']);
  $size       = clean_str($_POST['size']);

  $q = 'INSERT INTO hall (name, phone, address, rent, size, manager_id) VALUES (:name, :phone, :address, :rent, :size, :manager_id);';
  $data = ['name' => $name, 'phone' => $phone, 'address' => $address, 'rent' => $rent, 'size' => $size, 'manager_id' => $manager_id];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Hall Added Successfully.');
  }
}

?>
<h2>Add Hall</h2>
  <form method="post">
    <div class="form-group">
      <label for="name">Hall Name</label>
      <input type="text" name="name" required class="form-control" id="name" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" required class="form-control" id="phone" placeholder="Enter Phone">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" required class="form-control" id="address" placeholder="Enter Address">
    </div>
    <div class="form-group">
      <label for="rent">Rent</label>
      <input type="number" name="rent" required class="form-control" id="rent" placeholder="Enter Rent">
    </div>
    <div class="form-group">
      <label for="size">Size</label>
      <input type="number" name="size" required class="form-control" id="size" placeholder="Enter Size">
    </div>
    <div class="form-group">
      <label for="manager">Manager</label>
      <select name="manager_id" required class="form-control" id="manager">
        <option value="" disabled selected>Select Manager</option>
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
    <button type="submit" name="add" class="btn btn-primary">Submit</button>
  </form>

<?php
include 'inc/footer.inc.php';
