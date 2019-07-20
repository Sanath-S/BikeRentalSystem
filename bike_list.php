<!DOCTYPE html>
<html>
    <head>
        <title>Choose your ride</title>
        <link rel="stylesheet" type="text/css" href="bike.css" />
    </head>
    <body>

            <?php

                session_start();

                $pr_day=null;
                $pr_hr=null;

                $connection = mysqli_connect("localhost", "root", "", "bike");

                $select = " SELECT * FROM vehicles where status=0 order by vid  " ;
                $query = mysqli_query($connection, $select) ;
                while($row = mysqli_fetch_array($query)) {
                    $image = $row['image'];
                    $vname = $row['vname'];
                    $type = $row['tid'];
                    $engine = $row['engine'];
                    $speed = $row['speed'];
                    $power = $row['power'];
                    $vid = $row['vid'];
                    $_SESSION['vehicle'] = $vid;

                    $querry="SELECT type_of,phr,pday from type where tid='$type'";
                    $result=mysqli_query($connection,$querry);
                    $row1 = mysqli_fetch_array($result);
                    $type_dis = $row1[0];
                    $pr_hr = $row1[1];
                    $pr_day = $row1[2];
                    
            ?>

        <div class="row sport">
            <div class="colbikePic">
                   <?php  echo '<img class="bikes" src="pics/'.$image.'" height="150" width="150" >';  ?>
            </div>
            
            
            <div class="coldata">
                                                
                <table class="specs">
                    <tr><th colspan="5">  <?php  echo $vname;  ?>  </th></tr>
                    <tr>
                        <td><h5>TYPE</h5></td>
                        <td><h5>ENGINE</h5></td>
                        <td><h5>SPEED</h5></td>
                        <td><h5>POWER</h5></td>
                    </tr>
                    <tr>
                        <td><h5>  <?php  echo $type_dis;  ?>  </h5></td>
                        <td><h5>  <?php  echo $engine;  ?>  </h5></td>
                        <td><h5>  <?php  echo $speed;  ?>  </h5></td>
                        <td><h5>  <?php  echo $power;  ?>  </h5></td>
                    </tr>
                </table>
                
                <table class="pricing">
                    <tr>
                        <td><h5>1 hr</h5></td>
                        <td><h5>1 Day</h5></td>
                    </tr>
                    <tr>
                        <td><h5><span class="pd-price">  <?php  echo $pr_hr;  ?>  </span></h5></td>
                        <td><h5><span class="pd-price">  <?php  echo $pr_day;  ?>  </span></h5></td>
                        
                    </tr>
                </table>	

                  <div class="row orderBtn">
        
                        <a href="details.php"><button class= "Btn" value="<?php $vid; ?>" / >RIDE</button></a>	
                    
                  </div>
            </div>						
        </div>
                <?php } ?>
    </body>
</html>    