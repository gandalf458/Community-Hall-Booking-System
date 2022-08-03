<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $booking_id = (int)$_POST['booking_id'];

  try {
    $q = "DELETE FROM booking where booking_id = ?";
    $stmt = $pdo->prepare($q);
    $stmt->execute([$booking_id]);
    $result = $stmt->rowCount();
  } catch(PDOException $e) {
    $result = 0;
  }

  if (!$result) {    
    dangerMsg('There was an error.');
  } else {
    successMsg('Booking ID '.$booking_id.' deleted');
  }
}

$query = "SELECT booking_id, hall_id, client_id, description, date, slot FROM booking ORDER BY hall_id, date";
$bookings = $pdo->query($query);
?>
  
<h2 class="text-center">Bookings</h2>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Hall</th>
        <th>Client</th>
        <th>Description</th>
        <th>Date</th>
        <th>Slot</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($bookings as $r) {
    ?>
      <tr>
        <td><?=getHall($r['hall_id'])['name'];?></td>
        <td><?=getClient($r['client_id'])['name'];?></td>
        <td><?=$r['description'];?></td>
        <td><?=$r['date'];?></td>
        <td><?=$r['slot'];?></td>
        <td>
          <div class="btnPair">
            <a class="btnEdit" href="edit_booking.php?booking_id=<?=$r['booking_id']?>" role="button">Edit</a>
            <form method="post" class="inline">
              <input type="hidden" name="booking_id" value="<?=$r['booking_id']?>">
              <button type="submit" class="btnDelete" name="delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>
</div>
<a class="btnAdd" href="add_booking.php" role="button">Add</a>
<?php
include 'inc/footer.inc.php';
