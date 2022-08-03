<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $count = $pdo->query('SELECT count(1) FROM hall')->fetchColumn();
  if ($count < 2)
    $hall_id = $pdo->query('SELECT hall_id from hall LIMIT 1')->fetchColumn();
  else
    $hall_id     = clean_str($_POST['hall_id']);
  $client_id   = clean_str($_POST['client_id']);
  $description = clean_str($_POST['description']);
  $slot        = clean_str($_POST['slot']);
  $date        = clean_str($_POST['date']);

  $q = 'INSERT 
    INTO booking 
    (client_id, hall_id, description, slot, date) 
    VALUES 
    (:client_id, :hall_id, :description, :slot, :date)';
  $data = ['client_id' => $client_id, 'hall_id' => $hall_id, 'description' => $description, 'slot' => $slot, 'date' => $date];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  } else {
    successMsg('Hall Booked.');
  }
}

?>
  <h2>Hall Booking</h2>
  <form method="post">
    <div class="form-group">
      <label for="client">Client</label>
      <select name="client_id" required class="form-control" id="client">
        <option value="" disabled selected>Select Client</option>
        <?php
        $q = 'SELECT client_id, name FROM client';
        $rows = $pdo->query($q);
        foreach ($rows as $r) {
        ?>
        <option value="<?=$r['client_id']?>"><?=$r['name']?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" name="description" id="description" required class="form-control" placeholder="">
    </div>
    <?php
    $count = $pdo->query('SELECT count(1) FROM hall')->fetchColumn();
    if ($count > 1) {
    ?>
    <div class="form-group">
      <label for="hall">Hall</label>
      <select name="hall_id" required class="form-control" id="hall">
        <option value="" disabled selected>Select Hall</option>
      <?php
      $q = 'SELECT hall_id, name FROM hall';
      $rows = $pdo->query($q);
      foreach ($rows as $r) {
      ?>
        <option value="<?=$r['hall_id']?>"><?=$r['name']?></option>
      <?php
      }
      ?>
      </select>
    </div>
    <?php
    }
    ?>
    <div class="form-group">
      <label for="slot">Slot</label>
      <select  name="slot" required class="form-control" id="slot" placeholder="Enter Slot">
        <option disabled selected value="">Select Slot</option>
        <?php include 'inc/commonSlots.inc.php'; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" name="date" required class="form-control" id="date" placeholder="Enter Date">
    </div>
    <button type="submit" name="add" class="btn btn-primary">Submit</button>
  </form>

<?php
include 'inc/footer.inc.php';
