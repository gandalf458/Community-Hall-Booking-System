</main>
<footer class="footer">
  <div class="container">
    <span class="text-muted">&copy; Convention Hall Owners Association</span>
  </div>
</footer>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
// Only load script when needed
if (basename($_SERVER['PHP_SELF']) === 'view_client.php') {
  echo '<script src="js/clientSearch.js"></script>', "\n";
}
?>
</body>
</html>
