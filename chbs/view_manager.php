<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $managerId = (int)$_POST['manager_id'];
  $name = getManager($managerId)['name'];

  try {
    $q = "DELETE FROM manager where manager_id = ?";
    $stmt = $pdo->prepare($q);
    $stmt->execute([$managerId]);
    $result = $stmt->rowCount();
  } catch(PDOException $e) {
    $result = 0;
  }

  if (!$result) {
    dangerMsg('Can\'t delete manager. To delete first remove all <strong>Halls</strong> under him.');
  } else {
    successMsg('Manager '.$name.' deleted');
  }
}

$query = "SELECT * FROM manager";
$managers = $pdo->query($query);
?>
  
<h2 class="text-center">Managers</h2>                                                                                      
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($managers as $r) {
    ?>
      <tr>
        <td><?=$r['manager_id']?></td>
        <td><?=$r['name']?></td>
        <td><?=$r['phone']?></td>
        <td><?=$r['email']?></td>
        <td>
          <div class="btnPair">
            <a class="btnEdit" href="edit_manager.php?manager_id=<?=$r['manager_id']?>" role="button">Edit</a>
            <form method="post" class="inline">
              <input type="hidden" name="manager_id" value="<?=$r['manager_id']?>">
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
<a class="btnAdd" href="add_manager.php" role="button">Add</a>
<?php
include 'inc/footer.inc.php';
