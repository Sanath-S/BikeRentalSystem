<?php

    session_start();
    $connection = mysqli_connect("localhost", "root", "", "bike");

    if(isset($_POST['veh_delete'])) {

        $vno = $_POST['vnum'];

        $query="DELETE FROM vehicles WHERE vid = $vno";
        $result=mysqli_query($connection,$query);
    }

    
?> 


<!DOCTYPE html>
<html>
        <link rel="stylesheet" type="text/css" href="styling/style.css">

    <body>
        <form method="post" action="bike_remove.php">

            <div class="input-group">
  		        <label>Enter the vehicle id of the vehicle to be removed</label>
  		        <input type="text" name="vnum" >
            </div>
      
            <div class="input-group">
  		        <button type="submit" class="btn" name="veh_delete">Login</button>
  	        </div>

        </form>
    </body>
</html>
