<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $clientId = (int)$_POST['client_id'];
  $name = getClient($clientId)['name'];

  try {
    $q = "DELETE FROM client where client_id = ?";
    $stmt = $pdo->prepare($q);
    $stmt->execute([$clientId]);
    $result = $stmt->rowCount();
  } catch(PDOException $e) {
    $result = 0;
  }

  if (!$result) {
    dangerMsg('Can\'t delete client. To delete first remove all <strong>Bookings</strong> by him.');
  } else {
    successMsg('Client '.$name.' deleted');
  }
}

$query = "SELECT * FROM client";
$clients = $pdo->query($query);
?>
  
<h2 class="text-center">Clients</h2> 

<form>
  <input class="form-control" id="searchText" type="text" placeholder="Search by client name, phone, address etc." aria-label="Search">
</form>   
<br>
<div id="search-result">
  <?php include 'inc/commonClient.inc.php'; ?>
</div>
<a class="btnAdd" href="add_client.php" role="button">Add</a>
<?php
include 'inc/footer.inc.php';
