<?php
session_start();

// initializing variables
$username = "";                 
$license=null; 
$city=null;
$phno=null;
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'bike');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $phno = mysqli_real_escape_string($db, $_POST['phno']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $license = mysqli_real_escape_string($db, $_POST['license']);
  $city = mysqli_real_escape_string($db, $_POST['city']);




  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($phno)) { array_push($errors, "PhNo is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  if (empty($license)) { array_push($errors, "License is required"); }
  if (empty($city)) { array_push($errors, "City is required"); }
  }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or phno
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR license='$license' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['license'] === $license) {
      array_push($errors, "license already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, phno, password, license, city) 
  			  VALUES('$username', '$phno', '$password', '$license', '$city')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: terms.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }



  ?>