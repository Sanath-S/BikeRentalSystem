<?php 
    session_start();
    $a = session_destroy();
    if($a==true){
        echo("Logged out");
    }
    header("Location: index.php");
?>