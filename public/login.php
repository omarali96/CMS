<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php require_once("../includes/session.php") ?>
<?php include("../includes/validation_functions.php") ?>
<?php
$username = "";
if (isset($_POST['submit'])) {
  //process the form

  //validations

  $required_fields = array("username" , "password");
  validate_presences($required_fields);

  if (empty($errors)){
    // Create new admin
    $username = $_POST["username"];
    $password = $_POST["password"];
    $found_admin = login_check($username , $password);


    if ($found_admin) {
      $_SESSION["admin_id"] = $found_admin["id"];
      $_SESSION["username"] = $found_admin["username"];

      redirect_to("admin.php");
    }else {
      $_SESSION["message"] = "username/password not found";
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

    <h2>Login</h2>
    <form action="login.php" method="post">
      <p>Username:
        <input type="username" name="username" value="<?php echo htmlentities($username); ?>">
      </p>
      <p>Password:
        <input type="password" name="password" value="">
      </p>
      <input type="submit" name="submit" value="login">
    </form>

<?php include("../includes/views/footer.php"); ?>
