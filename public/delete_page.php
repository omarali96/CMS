<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php admin_area_access(); ?>

<?php
  $current_page = find_page_by_id($_GET["page"] , false);
  if (!$current_page) {
    redirect_to("manage_content.php");
  }
  $id = $current_page["id"];
  // $pages_set = find_all_pages_for_subject($id);
  //
  // if (mysqli_num_rows($pages_set) > 0) {
  //   $_SESSION["message"]= "Can't delete a subject with pages.";
  //   redirect_to("manage_content.php?subject={$id}");
  // }

  $query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
  if ( mysqli_query($connection, $query) && mysqli_affected_rows($connection)==1) {
    //Success
    $_SESSION["message"] = "Page deleted successfully";
    redirect_to( "manage_content.php");
  }else {

    //Failure
    $_SESSION["message"] = "Page deletion failed";
    redirect_to( "manage_content.php?page={$id}");

  }
 ?>
