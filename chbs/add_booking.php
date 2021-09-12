<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $client_id = $_POST['client_id'];
  $hall_id   = $_POST['hall_id'];
  $slot      = $_POST['slot'];
  $date      = $_POST['date'];

  $q = 'INSERT INTO booking (client_id, hall_id, slot, date) VALUES (:client_id, :hall_id, :slot, :date)';
  $data = ['client_id' => $client_id, 'hall_id' => $hall_id, 'slot' => $slot, 'date' => $date];
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
