<?php
/**
 * We would probably want a public version of this without giving access to the
 * maintenance routines, and without the client name
 */

include 'inc/header.inc.php';

$count = $pdo->query('SELECT count(1) FROM hall')->fetchColumn();
$hallDef = $pdo->query('SELECT hall_id from hall LIMIT 1')->fetchColumn();
?>

<h2 class="text-center">Upcoming Bookings</h2>
<?php
if ($count > 1) {
  // omit if only one hall
  ?>
  <form method="post">
    <div class="form-group">
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
  <!--  <button type="submit" name="add" class="btn btn-primary">Submit</button> -->
  </form>
  <br>

<?php
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $count < 2) {

$hallId = $_POST['hall_id'] ?? $hallDef;
$hallId = (int)$hallId;

$today = date('Y-m-d');
$query = 'SELECT
    booking_id, date, slot, client_id, description
  FROM
    booking
  WHERE
    hall_id = ? AND date > ?
  ORDER BY date';
$stmt = $pdo->prepare($query);
$stmt->execute([$hallId, $today]);
$bookings = $stmt->fetchAll();
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
?>

<h3 class="text-center">Bookings for <?=getHall($hallId)['name']?></h3>
  <div>
    <?php
    $oldm = 0;
    foreach ($bookings as $r) {
      $dateParts = explode('-', $r['date']);
      $month = $months[(int)$dateParts[1]-1];
      if ($oldm !== $month) {
        echo '<hr>';
        $oldm = $month;
      }
    ?>
      <h4><?=(int)$dateParts[2]?> <?=$month?> <?=$dateParts[0]?></h4>
      <p>
        <?=$r['slot'];?> -
        <?=getClient($r['client_id'])['name'];?> -
        <?=$r['description'];?>
    </p>
    <?php
    }
    ?>
  </div>
<?php
}
include 'inc/footer.inc.php';
