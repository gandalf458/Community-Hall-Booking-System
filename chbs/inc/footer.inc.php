</main>
<footer class="footer">
  <div class="container">
    <span class="text-muted">&copy; Convention Hall Owners Association</span>
  </div>
</footer>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
// Only load scripts if needed
if (basename($_SERVER['PHP_SELF']) === 'view_client.php') {
?>
  <script src="js/clientSearch.js"></script>
<?php
}
if (basename($_SERVER['PHP_SELF']) === 'show_bookings.php') {
?>
  <script>
  document.querySelector("#hall").addEventListener("change", function() {
    this.form.submit();
  })
  </script>
<?php
}
if (substr(basename($_SERVER['PHP_SELF']), 0, 5) === 'view_') {
?>
  <script src="js/areYouSure.js"></script>
<?php
}
?>
</body>
</html>
