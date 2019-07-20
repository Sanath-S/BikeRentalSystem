<?php
session_start();

// initializing variables
$aname = ""; 
$errors=array();
//connect to database
$db = mysqli_connect('localhost', 'root', '', 'bike');



  //admin login
  if (isset($_POST['login_admin'])) 
  {
    $aname = mysqli_real_escape_string($db, $_POST['aname']);
    $apassword = mysqli_real_escape_string($db, $_POST['apassword']);
  
    if (empty($aname)) {
        array_push($errors, "Admin name is required");
    }
    if (empty($apassword)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $aquery = "SELECT * FROM admin WHERE aname='$aname' AND apassword='$apassword'";
        $aresults = mysqli_query($db, $aquery);
        if (mysqli_num_rows($aresults) == 1) {
          $_SESSION['aname'] = $aname;
          $_SESSION['success'] = "You are now logged in";
          date_default_timezone_set('Asia/Kolkata');
          $logintime= date('Y-m-d H:i:s');
          $logs="UPDATE admin SET alogin='$logintime' where aname='$aname'"; 
          mysqli_query($db, $logs);
          header('location: admin_home.php');
        }else {
            array_push($errors, "Wrong Admin name/password combination");
        }
    }
  }
  

  ?>