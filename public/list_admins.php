<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php include("../includes/session.php") ?>
<?php include("../includes/views/header.php"); ?>

<?php admin_area_access(); ?>

<?php $admin_set = find_all_admins(); ?>
<div id="main">
  <div id="navigation">
    <a href="admin.php" style="font-weight:bold;"> &laquo;ِAdmin Menu</a>
    <a href="log_out.php" style="font-weight:bold;"> &laquo;Logout</a>

  </div>
<div id="page">
  <?php message(); ?>
  <h2>Manage admins</h2>
  <table>
    <tr>
      <th>Username</th>
      <th>Actions</th>
    </tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)){ ?>
      <tr>
        <td><?php echo htmlentities($admin["username"]); ?></td>
        <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>"
           >Edit</a>
           &nbsp
           <a href="delete_admin.php?id=<?php echo urlencode($admin["id"]);?>"
          onclick="return confirm('Are you sure?');" >Delete</a>

        </td>
      </tr>
      <?php } ?>
  </table>
  <br>
  <a href="new_admin.php">+ Add new admin</a>
<?php include("../includes/views/footer.php"); ?>
