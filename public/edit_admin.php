<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php require_once("../includes/session.php") ?>
<?php include("../includes/validation_functions.php") ?>
<?php admin_area_access(); ?>

<?php
  $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
    redirect_to("manage_admins.php");
  }
  if (isset($_POST['submit'])) {
    //process the form

    //validations
    $required_fields = array("username" , "password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);
    if (empty($errors)){
      // Create new admin
      $id = $admin["id"];
      $username = mysql_prep($_POST["username"]);
      $password = encrypt_password($_POST["password"]);

      $query  = "UPDATE admins SET ";
      $query .= " username = '{$username}' , ";
      $query .= " hashed_password = '{$password}' ";
      $query .= " WHERE id = {$id}";

      if (mysqli_query($connection,$query)&& mysqli_affected_rows($connection) == 1) {
        $_SESSION["message"] = "Admin Updated. ";
        redirect_to("list_admins.php");
      }else {
        $_SESSION["message"] = "Admin Updating failed. ";

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

      <h2>Edit Admin User</h2>
      <form action="edit_admin.php?id=<?php echo urlencode($admin["id"])?>" method="post">
        <p>Username:
          <input type="username" name="username" value="<?PHP echo $admin["username"]; ?>">
        </p>
        <p>Password:
          <input type="password" name="password" value="">
        </p>
        <input type="submit" name="submit" value="Edit Admin">
      </form>
      <br>
      <a href="list_admins.php">Cancel</a>
<?php include("../includes/views/footer.php"); ?>
