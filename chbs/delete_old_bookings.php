<?php
/**
 * Remove bookings that have passed
 */

include 'inc/header.inc.php';

$today = date('Y-m-d');
?>
<h2>Remove Old Bookings</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $query = 'DELETE FROM booking WHERE date < ?';
  $stmt = $pdo->prepare($query);
  $stmt->execute([$today]);
  successMsg('All old bookings removed.');

} else {
?>
  <p>This will delete all bookings earlier than <?=$today?>. Are you sure you wish to continue? This action cannot be undone.</p>
  <form method="post">
    <button type="submit" name="add" class="btn btn-primary">Confirm</button>
  </form>
<?php
}
include 'inc/footer.inc.php';
