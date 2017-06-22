
<!-- the file dedicated to display a side bar (included in almost every page) -->
<?php
//this line execute a function (database query)to fetch the subjects(categories)
//and set the returned data to a variable
$subject_set= find_all_subjects();
?>
 <ul class="subjects">
   <!-- display fetched data -->

   <?php while ($subject=mysqli_fetch_assoc($subject_set)) {?>
      <hr />
      <a href="index.php?subject=<?php echo urldecode( $subject["id"]); ?>">
        <!-- this snippet of code dedicated to display the selected item bolder -->
      <?php echo "<li";
        if($subject["id"]==$_GET["subject"]){
          echo " class=selected ";
        }
        echo ">";
      ?>
       <!-- this line prints the subject(category) in the naivgation -->
        <?php echo $subject[menu_name]; ?>
        <!-- query to get sub-subjects[pages] -->

        <?php
        $page_set=find_all_pages_for_subject($subject["id"]);
        ?>
         <hr />
        <ul class="pages">
          <!-- display fetched data -->
          <?php while ($page=mysqli_fetch_assoc($page_set)) {?>
            <a href="index.php?page=<?php echo urldecode( $page["id"]); ?>">
              <?php echo "<li";
                if($page["id"]==$_GET["page"]){
                  echo " class=selected ";
                }
                echo ">";
               ?>

                <?php echo $page[menu_name]; ?></li>
            </a>
          <?php } ?>
        </ul>
        <?php  mysqli_free_result($page_set);?>

      </li>
      </a>
    <?php } ?>
 </ul>
 <br />
 <a href="login.php" style="font-weight:bold;" >Login</a>
