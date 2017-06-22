 <?php
 //require_once("functions.php")
 define("DB_SERVER", "layout.com");
 define("DB_USER", "root");
 define("DB_PASS", "0m@r@li$$");
 define("DB_NAME", "cms");

   //1. create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  //test if connection succeeded
  if(mysqli_connect_errno()) {
	  die("Database connection failed: " .
	  mysqli_connect_error().
	  " (" . mysqli_connect_errno(). ")"
	  );
  }

?>
