<?php
ob_start();

#include 'inc/header.inc.php';
require_once 'inc/functions.php';

session_unset();
if (session_status() === PHP_SESSION_ACTIVE)
  session_destroy();
setcookie('loggedin', '', 1);
setcookie('admin',    '', 1);
setcookie('username', '', 1);
header('Location: index.php');
exit;
