<?php
/**
 * Backup database
 */

include 'inc/header.inc.php';

$today = date('Y-m-d-H-i-s');
?>
<h2>Backup Database</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $fromDb = 'chbs.sqlite';
  $toDb = 'backups/chbs-' . $today . '.sqlite';
  if (copy($fromDb, $toDb))
    successMsg('Database backed up.');
  else
    dangerMsg('Backup failed!');

} else {
?>
  <p>This will make a backup of the database.</p>
  <form method="post">
    <button type="submit" name="add" class="btn btn-primary">Confirm</button>
  </form>
<?php
}
include 'inc/footer.inc.php';
