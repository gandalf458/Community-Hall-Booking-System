<?php
include 'inc/header.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $client_id = $_POST['client_id'];
  $name = getClient($client_id)['name'];

// Are you sure?
  $q = "DELETE FROM client where client_id = ?";
  $stmt = $pdo->prepare($q);
  $stmt->execute([$client_id]);
  $result = $stmt->rowCount();

  if (!$result) {
    dangerMsg('Can\'t delete client. To delete first remove all <strong>Bookings</strong> by him.');
  } else {
    dangerMsg('Client '.$name.' deleted');
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
<?php
include 'inc/footer.inc.php';
