<?php
global $pdo;
$pdo = new PDO('sqlite:chbs.sqlite');
if (!$pdo)
  echo 'Connection Error';
$pdo->exec('PRAGMA foreign_keys = ON;');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#var_dump($pdo->query('PRAGMA foreign_keys')->fetch());
#die;

function successMsg($msg) {
  echo '<div class="alert alert-success">', $msg, '</div>';
}
function dangerMsg($msg) {
  echo '<div class="alert alert-danger">', $msg, '</div>';
}
function alertMsg($msg) {
  echo '<div class="alert alert-warning">', $msg, '</div>';
}

function getManager($id){
  global $pdo;
  $query = "SELECT * FROM manager where manager_id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);
  $r = $stmt->fetch();
  return $r;
}
function getClient($id){
  global $pdo;
  $query = "SELECT * FROM client where client_id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);
  $r = $stmt->fetch();
  return $r;
}
function getHall($id){
  global $pdo;
  $query = "SELECT * FROM hall where hall_id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);
  $r = $stmt->fetch();
  return $r;
}

function clean_str($str) {
  $str = trim($str);
  $str = htmlspecialchars($str);
  return $str;
}
