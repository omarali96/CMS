<?php include("../includes/session.php") ?>
<?php include ("../includes/views/admin_layout.php") ?>
<?php include("../includes/validation_functions.php") ?>
<?php admin_area_access(); ?>

<?php
find_selected_id();
$required_fields = array( "menu_name", "position", "visible" , "content" );
validate_presences($required_fields);

$fields_with_max_lengths=array("menu_name"=>30);
validate_max_lengths($fields_with_max_lengths);

if(empty($errors)){
  //perform Update
  $id = $current_page["id"];
  $menu_name = mysql_prep( $_POST['menu_name'] );
  $position  = (int) $_POST['position'] ;
  $visible   = (int) $_POST['visible'] ;
  $content   = mysql_prep($_POST["content"]);

  $query = "UPDATE pages SET ";
  $query .=" menu_name = '{$menu_name}', ";
  $query .= " position = {$position}, ";
  $query .= " visible = {$visible}, ";
  $query .=" content = '{$content}' ";
  $query .= "WHERE id={$id} ";
  $query .=" LIMIT 1";
  if ( mysqli_query($connection, $query) && mysqli_affected_rows($connection)==1)
   {
    //Success
    $_SESSION["message"] = "Page Updated successfully";
    redirect_to("manage_content.php");
  }else {
    //Failure
    $message="Page Updating failed";
  }

}
?>
<h2>Edit Page: <?php echo $current_page["menu_name"]; ?></h2>

  <?php
  if (!empty($message)) {
    echo "<div class=\"message\">".htmlentities($message)."</div>";
  }
  $errors = errors();
  echo form_errors($errors);
  ?>
  <form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
    <p>
      Page title:
      <input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]); ?>"/>
    </p>
    <p>
      Position:
      <select name="position">
        <?php
          $page_set = find_all_pages_for_subject($current_page["subject_id"],false);
          $page_count =mysqli_num_rows($page_set);
          for( $count = 1; $count <= $page_count; $count++ ) {
            echo "<option value=\"{$count}\"";
            if($current_page["position"]==$count){
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
      <?php if ($current_page["visible"]==0) {
        echo "checked";
      } ?>
      /> No
      &nbsp;
      <input type="radio" name="visible" value="1"
      <?php if ($current_page["visible"]>=0) {
        echo "checked";
      } ?> /> Yes
    </p>
    <p>
     Content :<br>
     <textarea name="content" rows="20" cols="80"><?php echo htmlentities($current_page["content"]);?></textarea>
    </p>
    <input type="submit" name="submit" value="Edit Page"/>

    </form>

    <br/>
  <a href="manage_content.php">Cancel</a>
  &nbsp &nbsp &nbsp
  <a href="delete_page.php?page=<?php echo urlencode($current_page["id"]);?>"
    onclick="return confirm('Are you sure?');">Delete</a>

    <!-- release the fetched data -->
<?php  mysqli_free_result($subject_set); ?>
<?php include("../includes/views/footer.php"); ?>
