<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php require_once("../includes/session.php") ?>
<?php include("../includes/validation_functions.php") ?>
<?php admin_area_access(); ?>

<?php
if (isset($_POST['submit'])) {
  //process the form

  //validations
  $required_fields = array("username" , "password");
  validate_presences($required_fields);

  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  if (empty($errors)){
    // Create new admin

    $username = mysql_prep($_POST["username"]);
    $password = encrypt_password($_POST["password"]);

    $query  = "INSERT INTO admins (";
    $query .= " username , hashed_password";
    $query .= " ) VALUES (";
    $query .= " '{$username}' , '{$password}' )";

    if (mysqli_query($connection,$query)) {
      $_SESSION["message"] = "Admin created. ";
      redirect_to("list_admins.php");
    }else {
      $_SESSION["message"] = "Admin creation failed. ";

    }

  }else {

  }
}
 ?>
 <?php include("../includes/views/header.php"); ?>
 <!-- this file aimed to make things under admin control -->
 <?php $admin_set = find_all_admins(); ?>
 <div id="main">
   <div id="navigation">
   </div>
 <div id="page">
   <?php echo message();
         echo form_errors($errors);
    ?>

    <h2>Create Admin</h2>
    <form action="new_admin.php" method="post">
      <p>Username:
        <input type="username" name="username" value="">
      </p>
      <p>Password:
        <input type="password" name="password" value="">
      </p>
      <input type="submit" name="submit" value="Create Admin">
    </form>
    <br>
    <a href="list_admins.php">Cancel</a>

<?php include("../includes/views/footer.php"); ?>
