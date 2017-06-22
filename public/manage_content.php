<?php include("../includes/session.php") ?>
<?php include ("../includes/views/admin_layout.php") ?>
<?php admin_area_access(); ?>

    <h2>Manage Content</h2>
    <!-- just shit -->
    <?php message(); ?>
    <?php if($current_subject){?>
      <h3>Manage Subject</h3>
      Menu Name :<?php echo htmlentities($current_subject["menu_name"]); ?>
      <br>
      Position :<?php echo $current_subject["position"]; ?>
      <br>
      Visible :<?php echo $current_subject["visible"] ==1 ? 'Yes' : 'No' ; ?>
      <br><br>
      <a class="edit" href="edit_subject.php?subject=<?php echo
      $current_subject["id"]; ?>">Edit Subject</a>
      <div class="">
        <h3>Pages in this Subjuct</h3>
        <ul>
          <?php $subject_pages = find_all_pages_for_subject($current_subject["id"],false);
          while ($page = mysqli_fetch_assoc($subject_pages)) {
            echo "<li>";
            $safe_page_id = urlencode($page["id"]);
            echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
            echo htmlentities($page["menu_name"]);
            echo "</a>";
            echo "</li>";

          }
           ?>
        </ul>
        <br />
        + <a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>">
          Add a new page to this subject</a>
      </div>
<?php
    }elseif ($current_page) {
      echo "<h3>Manage Page</h3>";
      echo "<br>Menu Name :";
      echo htmlentities($current_page["menu_name"]);
      echo "<br> Position :";
      echo $current_page["position"];
      echo "<br> Visible :";
      echo $current_page["visible"] ==1 ? 'Yes' : 'No' ;
      echo "<br><br>";
      echo "Content :<br>";
      echo $current_page["content"];
      echo "<br><div class=\"edit\"> ";
      echo "<a href=\"edit_page.php?page={$current_page["id"]}\">Edit page<a/></div>";
    }else {

      echo "Select a Subjuct OR Page.";

    }
     ?>


    <!-- release the fetched data -->
<?php  mysqli_free_result($subject_set);?>
<?php include("../includes/views/footer.php"); ?>
