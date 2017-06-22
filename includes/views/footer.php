</div>
</div>
<div id="footer">
  <p>&copy;All Rights are Reserved</p>
  <?php echo date("Y"); ?>
  <a href="#">Back to the top^</a>
</div>
</body>
</html>
<?php // Free result set
  //mysqli_free_result($result);
  //close database connection
  if (isset($connection)){mysqli_close($connection);}
   ?>
