<?php require_once("../includes/db_connection.php"); ?>
<?php include("header.php"); ?>
<?php require_once("../includes/functions.php") ?>
  <!-- this nested if aimed checking the selected item is it subject(category) or page -->
  <?php find_selected_id(); ?>
  <div id= "main">
     <div id= "navigation">
       <!-- this include statment includes the navigation (side-bar)
        -for more details about how it works go to /includes/navigation_bar.php -->
      <?php include ("../includes/public_navigation.php"); ?>
     </div>
  <div id="page">
