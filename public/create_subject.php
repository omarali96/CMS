<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php include("../includes/validation_functions.php") ?>
<?php admin_area_access(); ?>

<?php
$menu_name = mysql_prep( $_POST['menu_name'] );
$position  = (int) $_POST['position'] ;
$visible   = (int) $_POST['visible'] ;

$required_fields = array( "menu_name", "position", "visible" );
validate_presences($required_fields);

$fields_with_max_lengths=array("menu_name"=>30);
validate_max_lengths($fields_with_max_lengths);

if(!empty($errors)){
  $_SESSION["errors"] = $errors;
  redirect_to("new_subject.php");
}

$query = "INSERT INTO subjects
(menu_name, position, visible)
 VALUES ( '{$menu_name}', {$position}, {$visible})";

if ( mysqli_query($connection, $query) ) {
  $_SESSION["message"] = "Subject Added successfully";
  redirect_to( "manage_content.php");
} else {
	// Display error message
  $_SESSION["message"] = "Adding Subject failed";
  redirect_to( "new_subject.php");
}
  ?>
<?php if (isset($connection)){mysqli_close($connection);} ?>
