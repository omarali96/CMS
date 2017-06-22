<?php
  function mysql_prep($string){
    global $connection;

    $escaped_string=mysqli_real_escape_string($connection,$string);

    return $escaped_string;
  }

  function redirect_to($location) {
      header( "Location: " .$location );
      exit;

    }

  function confirm_query($set_result){
    if(!$set_result){
      die("query failed");
    }
   }

  function form_errors($errors = array()){
    $output = "";
    if(!empty($errors)){
      $output .= "<div class = \"errors\">";
      $output .= "Please fix the following errors :";
      $output .= "<ul>";
      foreach ($errors as $key => $error) {
        $output .="<li>";
        $output .=htmlentities($error);
        $output .="</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  function find_all_subjects($public=true){
    global $connection;

    $query ="SELECT * FROM subjects "  ;
    if ($public) {
      $query .="WHERE visible = 1 ";
    }
    $query .="ORDER by position ASC ";
    $subject_set = mysqli_query($connection, $query);
    confirm_query($subject_set);
    return $subject_set;
  }

  function find_all_pages_for_subject($subject_id , $public = true){
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);


    $query  ="SELECT * FROM pages "  ;
    $query .="WHERE subject_id={$safe_subject_id} ";
    if ($public) {
      $query .="AND visible = 1 ";
    }
    $query .="ORDER BY position ASC ";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);

    return $page_set;
  }

  function find_subject_by_id($subject_id , $public = true){
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);

    $query ="SELECT * FROM subjects "  ;
    $query .="WHERE id ={$safe_subject_id} ";
    if ($public) {
      $query .= "AND visible = 1 ";
    }
    $query .="LIMIT 1";
    $subject_set = mysqli_query($connection, $query);
    confirm_query($subject_set);
    if($subject = mysqli_fetch_assoc($subject_set)){
      return $subject;
    }else{
      return null;
    }
  }

  function find_page_by_id ($page_id , $public = true){
      global $connection;
      $current_subject = $_GET["subject"];

      $safe_page_id = mysqli_real_escape_string($connection,$page_id);

      $query ="SELECT * FROM pages "  ;
      $query .="WHERE id ={$safe_page_id} ";
      if ($public) {
        $query .= "AND visible = 1 ";
      }
      $query .="LIMIT 1";
      $page_set = mysqli_query($connection, $query);
      confirm_query($page_set);
      if($page = mysqli_fetch_assoc($page_set)){
        return $page;
      }else{
        return null;
      }
  }

  function find_selected_id($public = true){
    global $current_subject;
    global $current_page;
    if(isset( $_GET["subject"] )){

      $current_subject = find_subject_by_id($_GET["subject"] , $public);

      $current_page=null;

    }elseif(isset($_GET["page"])) {

      $current_page = find_page_by_id($_GET["page"], $public );

      $current_subject=null;
    }else{

      $current_subject=null;

      $current_page=null;
    }

  }

  function find_all_admins(){
    global $connection;

    $query ="SELECT * FROM admins "  ;
    $query .="ORDER by id ASC ";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
  }

  function find_admin_by_id($admin_id){
    global $connection;

    $safe_admin_id = mysqli_real_escape_string($connection,$admin_id);

    $query ="SELECT * FROM admins "  ;
    $query .="WHERE id ={$safe_admin_id} ";
    $query .="LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)){
      return $admin;
    }else{
      return null;
    }
}

  function generate_salt($length){

    $unique_random_string = md5(uniqid(mt_rand(),true));

    //valid characters for salt are [a-z,A-Z,0-9,./]
    $base64_string = base64_encode($unique_random_string);

    //replace + with . in base64_string
    $modified_base64_string = str_replace('+','.',$base64_string);

    // truncate string to the correct length
    $salt = substr($modified_base64_string , 0 , $length);

    return $salt;
  }

  function password_check($entered_password , $hashed){

    //this function works exactly the same as php built-in function password_verify()
    $hash  = crypt($entered_password , $hashed);

    if ($hash === $hashed) {
      return true;
    } else {
      return false;
    }
  }

  function encrypt_password($password){
    //this function works exactly the same as php built-in function password_hash()
    $hash_format = "$2y$10$";
    $salt_length = 22;
    $salt = generate_salt($salt_length);

    $format_and_salt = $hash_format . $salt;

    $hash = crypt($password , $format_and_salt);

    return $hash;
  }

  function find_admin_by_username($username){
    global $connection;

    $safe_username = mysqli_real_escape_string($connection,$username);

    $query ="SELECT * FROM admins "  ;
    $query .="WHERE username = '{$safe_username}' ";
    $query .="LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)){
      return $admin;
    }else{
      return null;
    }
}

    function login_check($username , $password){
      $admin = find_admin_by_username($username);

      if ($admin) {

        if (password_verify($password , $admin["hashed_password"])) {
          return $admin;
        }else {
          return false;
        }
      } else {
        return false;
      }

    }
    
    function check_logged_in(){
      $admin_id = $_SESSION['admin_id'];
      return $admin_id;
    }

    function admin_area_access(){
      if(!check_logged_in()){
        redirect_to("login.php");
      }
    }

?>
