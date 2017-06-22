<?php include("../includes/session.php") ?>
<?php include ("../includes/views/admin_layout.php") ?>
<?php include("../includes/validation_functions.php") ?>

<?php admin_area_access(); ?>

<?php

$required_fields = array( "menu_name", "position", "visible" );
validate_presences($required_fields);

$fields_with_max_lengths=array("menu_name"=>30);
validate_max_lengths($fields_with_max_lengths);

if(empty($errors)){
  //perform Update
  $id = $current_subject["id"];
  $menu_name = mysql_prep( $_POST['menu_name'] );
  $position  = (int) $_POST['position'] ;
  $visible   = (int) $_POST['visible'] ;

  $query = "UPDATE subjects SET ";
  $query .=" menu_name = '{$menu_name}', ";
  $query .= " position = '{$position}', ";
  $query .= " visible = '{$visible}' ";
  $query .= "WHERE id={$id} ";
  $query .=" LIMIT 1";
  if ( mysqli_query($connection, $query) && mysqli_affected_rows($connection)==1)
   {
    //Success
    $_SESSION["message"] = "Subject Updated successfully";
    redirect_to( "manage_content.php");
  }else {
    //Failure
    $message="Subject Updating failed";
  }

}
?>
<h2>Edit Subject: <?php echo $current_subject["menu_name"]; ?></h2>

  <?php
  if (!empty($message)) {
    echo "<div class=\"message\">" . htmlentities($message) ."</div>";
  }
  $errors = errors();
  echo form_errors($errors);
  ?>
  <form action="edit_subject.php?subject=
  <?php echo urlencode($current_subject["id"]); ?>" method="post">
    <p>
      Subject name:
      <input type="text" name="menu_name" value="
      <?php echo htmlentities($current_subject["menu_name"]); ?>"/>
    </p>
    <p>
      Position:
      <select name="position">
        <?php

          $subject_count =mysqli_num_rows( $subject_set );
          for( $count = 1; $count <= $subject_count; $count++ ) {
            echo "<option value=\"{$count}\"";
            if($current_subject["position"]==$count){
              echo " selected";
            }
            echo ">{$count}</option>";
          }
        ?>
      </select>
    </p>
    <p>
      Visible:
      <input type="radio" name="visible" value="0"
      <?php if ($current_subject["visible"]==0) {
        echo "checked";
      } ?>
      /> No
      &nbsp;
      <input type="radio" name="visible" value="1"
      <?php if ($current_subject["visible"]>=0) {
        echo "checked";
      } ?> /> Yes
    </p>
    <input type="submit" name="submit" value="Edit Subject" />

    </form>

    <br/>
  <a href="manage_content.php">Cancel</a>
  &nbsp &nbsp &nbsp
  <a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>"
    onclick="return confirm('Are you sure?');">Delete</a>

    <!-- release the fetched data -->
<?php  mysqli_free_result($subject_set); ?>
<?php include("../includes/views/footer.php"); ?>
