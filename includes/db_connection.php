 <?php
 //require_once("functions.php")
 define("DB_SERVER", "");
 define("DB_USER", "");
 define("DB_PASS", "");
 define("DB_NAME", "");

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
