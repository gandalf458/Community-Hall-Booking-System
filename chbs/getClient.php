<?php
include 'inc/functions.php';
#var_dump($_POST); die;
if ($_POST['search_name'] == '') {
  $query = "SELECT * FROM client";
} else {
  $query = "SELECT * FROM client where name like '%{$_POST['search_name']}%' OR phone like '%{$_POST['search_name']}%' OR address like '%{$_POST['search_name']}%' OR email like '%{$_POST['search_name']}%' ";
}
$clients = $pdo->query($query);
if ($clients) {
  include 'inc/commonClient.inc.php';
} else {
  dangermsg('No Match Found.');
}
