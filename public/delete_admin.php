<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php require_once("../includes/session.php") ?>
<?php admin_area_access(); ?>

<?php
  $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
    redirect_to("manage_admins.php");
  }
  $id = $admin["id"];
  $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";

  if (mysqli_query($connection,$query)&& mysqli_affected_rows($connection) == 1) {
    $_SESSION["message"] = "Admin Deleted. ";
    redirect_to("list_admins.php");
  }else {
    $_SESSION["message"] = "Admin Deleting failed. ";
    redirect_to("list_admins.php");
  }
?>
