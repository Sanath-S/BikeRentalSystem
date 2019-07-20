<?php

    session_start();

?>


<!DOCTYPE html>
<html>
        <link rel="stylesheet" type="text/css" href="styling/style.css">

    <body>
        

            <div class="input-group">
  		        <label>click to add vehicles</label>
                <a href="bike_add.php"><button class= "Btn" value="01" >ADD</button></a>
            </div>

            <div class="input-group">
  		        <label>click to delete vehicles</label>
                <a href="bike_remove.php"><button class= "Btn" value="01" >REMOVE</button></a>
            </div>

            <div class="input-group">
  		        <label>click to approve booking</label>
                <a href="admin_approval.php"><button class= "Btn" value="01" >APPROVE</button></a>
            </div>
      
            

        </form>
    </body>
</html>