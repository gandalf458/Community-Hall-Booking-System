<?php include 'inc/header.inc.php'; ?>
<!--
<h2>Find Booking</h2>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" name="booking_id" placeholder="Enter Booking ID" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Submit</button>
  </form>
 <br>
 <br>
 <br>
-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $booking_id  = clean_str($_POST['booking_id']);
  $client_id   = clean_str($_POST['client_id']);
  $description = clean_str($_POST['description']);
  $hall_id     = clean_str($_POST['hall_id']);
  $slot        = clean_str($_POST['slot']);
  $date        = clean_str($_POST['date']);

  $q = 'UPDATE 
      booking
    SET
      client_id=:client_id, description=:description, hall_id=:hall_id, slot=:slot, date=:date
    WHERE
      booking_id = :booking_id';
  $data = ['hall_id' => $hall_id, 'slot' => $slot, 'date' => $date, 'booking_id' => $booking_id, 'client_id' => $client_id, 'description' => $description];
  $stmt = $pdo->prepare($q);
  $stmt->execute($data);

  if (!$stmt) {
    dangerMsg('There was an error.');
  }
  else{
    successMsg('Booking Updated Successfully.');
  }
}

if (isset($_GET['booking_id'])) {

  $booking_id = $_GET['booking_id'];
  $q = 'SELECT client_id, hall_id, description, slot, date FROM booking where booking_id = ?';
  $stmt = $pdo->prepare($q);
  $stmt->execute([$booking_id]);
  $booking = $stmt->fetch();
  if ($booking) {
    $client_id   = $booking['client_id'];
    $description = $booking['description'];
    $hall_id     = $booking['hall_id'];
    $slot        = $booking['slot'];
    $date        = $booking['date'];
?>

  <h2>Edit Booking ID: <?=$booking_id?></h2>
  <form method="post" action="edit_booking.php">
    <input type="hidden" name="booking_id" value="<?=$booking_id?>">
   <div class="form-group">
      <label for="client">Client</label>
      <select name="client_id" required class="form-control" id="client"> 
        <option value="<?=$client_id?>" selected><?=getClient($client_id)['name']?></option>
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
      <input type="text" name="description" value="<?=$description?>" id="description" required class="form-control" placeholder="">
    </div>
    <div class="form-group">
      <label for="hall">Hall</label>
      <select name="hall_id" required class="form-control" id="hall"> 
        <option value="<?=$hall_id?>" selected><?=getHall($hall_id)['name']?></option>
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
      <select  name="slot" required class="form-control" id="slot">
        <option value="<?=$slot?>" selected><?=$slot?></option>
        <?php include 'inc/commonSlots.inc.php'; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" name="date" value="<?=$date?>" required class="form-control" id="date">
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
  <?php
  } else {
    alertMsg('Booking ID: <strong>'.$booking_id.'</strong> Not Found.');
  }
}
include 'inc/footer.inc.php';
