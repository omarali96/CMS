<?php include("../includes/session.php") ?>
<?php include ("../includes/views/admin_layout.php") ?>
<?php admin_area_access(); ?>

<h2>Add Subject</h2>

  <?php
  message();
  $errors = errors();
  echo form_errors($errors);
  ?>
  <form action="create_subject.php" method="post">
    <p>
      Subject name:
      <input type="text" name="menu_name" value=""/>
    </p>
    <p>
      Position:
      <select name="position">
        <?php

          $subject_count =mysqli_num_rows( $subject_set );
          for( $count = 1; $count <= $subject_count+1; $count++ ) {
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
    <input type="submit" name="submit" value="Add Subject" />

    </form>

    <br/>
  <a href="manage_content.php">Cancel</a>

    <!-- release the fetched data -->
<?php  mysqli_free_result($subject_set); ?>
<?php include("../includes/views/footer.php"); ?>
