<?php include("../includes/session.php"); ?>
<?php include("../includes/functions.php"); ?>
<?php include("../includes/views/header.php"); ?>
<?php admin_area_access(); ?>
<!-- this file aimed to make things under admin control -->
<div id="main">
  <div id="navigation">
  </div>
<div id="page">
  <h2>Admin Menu</h2>
  <p>welcome to the admin area <?php echo htmlentities($_SESSION["username"]); ?></p>
  <ul>
    <li><a href="manage_content.php">Manage Content</a></li>
    <li><a href="list_admins.php">Manage users</a></li>
    <li><a href="log_out.php">Logout</a></li>
  </ul>
<?php include("../includes/views/footer.php"); ?>
