<?php include ("../includes/views/public_layout.php") ?>
    <!-- just shit -->
    <?php if($current_subject){?>

      <div class="">
        <h2><?php echo $current_subject["menu_name"]; ?></h2>
        <h3>Pages in this Subjuct</h3>
        <ul>
          <?php $subject_pages = find_all_pages_for_subject($current_subject["id"]);
          while ($page = mysqli_fetch_assoc($subject_pages)) {
            echo "<li>";
            $safe_page_id = urlencode($page["id"]);
            echo "<a href=\"index.php?page={$safe_page_id}\">";
            echo htmlentities($page["menu_name"]);
            echo "</a>";
            echo "</li>";

          }
           ?>
        </ul>
        <br />
      </div>
<?php
    }elseif ($current_page) {
      echo "<h2>";
      echo htmlentities($current_page["menu_name"]);
      echo "</h2>";
      echo "<br>Content :<br>";
      echo nl2br(htmlentities ($current_page["content"]));
    }else {

      echo "Welcome.";

    }
     ?>


    <!-- release the fetched data -->
<?php  mysqli_free_result($subject_set);?>
<?php include("../includes/views/footer.php"); ?>
