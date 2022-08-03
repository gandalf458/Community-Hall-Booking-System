<?php include 'inc/header.inc.php';?>

<div class="hpblock">
  <h2>Community Hall Booking System Admin</h2>
  <p class="logo"><img src="img/logo.png" alt="logo" width="120" height="120"></p>
  <div class="navBox">
    <a class="navC" href="view_client.php">View Clients</a>
    <a class="navH" href="view_hall.php">View Halls</a>
    <a class="navM" href="view_manager.php">View Managers</a>
    <a class="navB" href="view_booking.php">View Bookings</a>
    <a class="navC" href="add_client.php">Add Client</a>
    <a class="navH" href="add_hall.php">Add Hall</a>
    <a class="navM" href="add_manager.php">Add Manager</a>
    <a class="navB" href="add_booking.php">Add Booking</a>
  </div>
  <?php
  /**
   * Will need to change the message below depending on the installation
   */
  ?>
  <p>A demonstration of a hall booking system. <a href="https://github.com/gandalf458/Community-Hall-Booking-System">Fork me at GitHub</a>.</p>
</div>

<?php include 'inc/footer.inc.php';?>
