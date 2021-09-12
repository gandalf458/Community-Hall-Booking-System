<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $hall_id = $_POST['hall_id'];
  $name = getHall($hall_id)['name'];

// Are you sure?
// check there are no booking for this hall
  $q = "DELETE FROM hall where hall_id = ?";
  $stmt = $pdo->prepare($q);
  $stmt->execute([$hall_id]);
  $result = $stmt->rowCount();

  if (!$result) {
    dangerMsg('Can\'t delete hall. To delete first remove all <strong>Bookings</strong> of <strong>'.$name.'</strong>.');
  }  else {
    dangerMsg('Hall '.$name.' deleted');
  }
}

$query = "SELECT * FROM hall";
$halls = $pdo->query($query);
?>
  
<h2 class="text-center">Halls</h2>                                                                                      
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Rent</th>
        <th>Size</th>
        <th>Manager</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($halls as $r) {
    ?>
      <tr>
        <td><?=$r['hall_id']?></td>
        <td><?=$r['name']?></td>
        <td><?=$r['phone']?></td>
        <td><?=$r['address']?></td>
        <td><?=$r['rent']?></td>
        <td><?=$r['size']?></td>
        <td><?=$r['manager_id']?></td>
        <td>
          <div class="btnPair">
            <a class="btnEdit" href="edit_hall.php?hall_id=<?=$r['hall_id']?>" role="button">Edit</a>
            <form method="post" class="inline">
              <input type="hidden" name="hall_id" value="<?=$r['hall_id']?>">
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
<?php
include 'inc/footer.inc.php';
