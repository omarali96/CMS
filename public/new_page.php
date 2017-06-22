<?php include("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php include("../includes/validation_functions.php") ?>
<?php admin_area_access(); ?>

<?php
  find_selected_id();
  if (!$current_subject) {
    redirect_to("manage_content.php");
  }

  if (isset($_POST['submit'])) {
    //process the form

    //validations
    $required_fields = array("menu_name","position","visible","content");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if(empty($errors)){
      // perform page Creation

      $subject_id = $current_subject["id"];

      $menu_name = mysql_prep( $_POST['menu_name'] );
      $position  = (int) $_POST['position'] ;
      $visible   = (int) $_POST['visible'] ;
      $content   = mysql_prep($_POST['content'] );

      $query = "INSERT INTO pages (";
      $query .="  subject_id , menu_name , position , visible , content";
      $query .=") VALUES (";
      $query .=" {$subject_id} , '{$menu_name}' , {$position} , {$visible} ,
       '{$content}' )";
      if (mysqli_query($connection, $query)) {
        //Success
        $_SESSION["message"] = "Page created successfully.";
        redirect_to("manage_content.php?subject=" . urlencode($current_subject["id"]));

      } else {
          //Failure
          $_SESSION["message"] = "Page Creation Failed.";

      }
    }else {
      //

    }
  }
 ?>
 <?php require_once ("../includes/views/admin_layout.php") ?>
 <h2>Creaete Page</h2>

   <?php
   message();
   $errors = errors();
   echo form_errors($errors);
   ?>
   <form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
     <p>
       Page name:
       <input type="text" name="menu_name" value=""/>
     </p>
     <p>
       Position:
       <select name="position">
         <?php
           $page_set = find_all_pages_for_subject($current_subject["id"]);
           $page_count = mysqli_num_rows( $page_set );
           for( $count = 1; $count <= $page_count+1; $count++ ) {
             echo "<option value=\"{$count}\">{$count}</option>";
           }
         ?>
       </select>
     </p>
     <p>
       Visible:
       <input type="radio" name="visible" value="0" /> No
       &nbsp;
       <input type="radio" name="visible" value="1" /> Yes
     </p>
    <p>
     Content :<br>
     <textarea name="content" rows="20" cols="80"></textarea>
    </p>
     <input type="submit" name="submit" value="Create Page" />

     </form>

     <br/>
   <a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]);?>">Cancel</a>

<?php include("../includes/views/footer.php") ?>
