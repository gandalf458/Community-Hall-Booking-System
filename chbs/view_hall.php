<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $hallId = (int)$_POST['hall_id'];
  $name = getHall($hallId)['name'];

  try {
    $q = "DELETE FROM hall WHERE hall_id = ?";
    $stmt = $pdo->prepare($q);
    $stmt->execute([$hallId]);
    $result = $stmt->rowCount();
  } catch(PDOException $e) {
    $result = 0;
  }

  if (!$result) {
    dangerMsg('Can\'t delete hall. To delete first remove all <strong>Bookings</strong> for the hall.');
  }  else {
    successMsg('Hall '.$name.' deleted');
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
<a class="btnAdd" href="add_hall.php" role="button">Add</a>
<?php
include 'inc/footer.inc.php';
