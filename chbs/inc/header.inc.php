<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="EN">
<head>
<title>Community Hall Booking System</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href=".">Community Hall Booking System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="view_client.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clients</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="view_client.php">View Clients</a>
          <a class="dropdown-item" href="add_client.php">Add Client</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="view_hall.php" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Halls</a>
        <div class="dropdown-menu" aria-labelledby="dropdown02">
          <a class="dropdown-item" href="view_hall.php">View Halls</a>
          <a class="dropdown-item" href="add_hall.php">Add Hall</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="view_manager.php" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Managers</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="view_manager.php">View Managers</a>
          <a class="dropdown-item" href="add_manager.php">Add Manager</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="view_booking.php" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bookings</a>
        <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item" href="view_booking.php">View Bookings</a>
          <a class="dropdown-item" href="add_booking.php">Add Booking</a>
        </div>
      </li>
    </ul>
<!--    <a class="btn btn-success my-2 my-sm-0" href="logout.php" role="button">Logout []</a> -->
  </div>
</nav>
<main class="container">
