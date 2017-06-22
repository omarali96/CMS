<?php
	session_start();

	function message(){
		if (isset($_SESSION["message"])) {
	  echo "<div class=\"status_message\">";
	  echo htmlentities($_SESSION["message"]);
	  echo"</div>"; }
		$_SESSION["message"]=null;
	}

	function errors(){
		if (isset($_SESSION["errors"])) {
	  $errors= $_SESSION["errors"];
	  }
		$_SESSION["errors"]=null;
		return $errors;
	} 

	function logged_in() {
		return isset( $_SESSION['user_id'] );
	}

	function confirm_logged_in() {
		if ( !logged_in() ) {
			redirect_to( "login.php" );
		}
	}
	?>
