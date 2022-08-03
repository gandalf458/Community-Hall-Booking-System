<?php
/**
 * Common code for view_client.php and getClient
 */
?>
<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($clients as $r) {
    ?>
      <tr>
        <td><?=$r['name']?></td>
        <td><?=$r['phone']?></td>
        <td><?=$r['address']?></td>
        <td><?=$r['email']?></td>
        <td>
          <div class="btnPair">
            <a class="btnEdit" href="edit_client.php?client_id=<?=$r['client_id']?>" role="button">Edit</a>
            <form method="post" class="inline">
              <input type="hidden" name="client_id" value="<?=$r['client_id']?>">
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
