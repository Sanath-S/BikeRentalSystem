<?php

        session_start();

        $bid = null;
        $vname = null;
        $pdate = null;
        $ptime = null;
        $ddate = null;
        $dtime = null;
        $phone= null;
        $cost = null;
        $user = $_SESSION['username'];
        $veh = $_SESSION['vehicle'];
        $bid = $_SESSION['booking'];

        $db = mysqli_connect("localhost", "root", "", "bike");

        //phr
        $query5 = "SELECT phr from type where tid in (select tid from vehicles where vid = '$veh')";
        $result5 = mysqli_query($db,$query5);
        $row5 = mysqli_fetch_array($result5);
        $phr = $row5[0];

        //vname
        $query4 = "SELECT vid,vname from vehicles where vid = '$veh'";
        $result4 = mysqli_query($db,$query4);
        $row4 = mysqli_fetch_array($result4);
        $vid = $row4[0];
        $vname = $row4[1];
        
        //fetch single value from database
        $query = "SELECT id,city from users where username = '$user'";
        $result = mysqli_query($db,$query);
        $row3 = mysqli_fetch_array($result);
        $uid = $row3[0];
        $city = $row3[1];

        $querry = "SELECT bid,pdate,ptime,ddate,dtime,phone,hours,cost FROM booking WHERE bid=$bid";
        $res = mysqli_query($db, $querry);
        
        while($row = mysqli_fetch_row($res)) {
            $bid = $row[0];
            $pdate = $row[1];
            $ptime = $row[2];
            $ddate = $row[3];
            $dtime = $row[4];
            $phone = $row[5];
            $hours = $row[6];
            $cost = $row[7];
        }

?>

<html>
    <head>
        <title>ORDER SUMMARY</title>
        <link rel="stylesheet" type="text/css" href="summary.css">
    </head>
    <body>
        <div class="box1" style="width: 69000px; height: 50px; ">
            <h1>Booking Summary</h1>
        </div>

        <div class="box2" style="width: 500px; height: 270px; ">
            <h4>Name:  <?php  echo $user;  ?></h4>
            <h4>Booking ID:  <?php  echo $bid;  ?></h4>
            <h4>Vehicle name:  <?php  echo $vname;  ?></h4>
            <h4>Pick-up date:  <?php  echo $pdate;  ?></h4>
            <h4>Pick-up time:  <?php  echo $ptime;  ?></h4>
            <h4>Phone number:  <?php  echo $phone;  ?></h4>
            <h4>Location:  <?php  echo $city;  ?></h4>
        </div>

             
        <div class="box3"style="width: 500px; height: 170px; "><h4>Rental Charges: </h4>
                 <h2>Cost/hr:  <?php  echo $phr;  ?>  </h2>
                 <h2>Duration:  <?php  echo $hours;  ?> </h2>
                <h2>Total Cost: <?php  echo $cost;  ?></h2>

        </div>

        <div class="box" style="width:600px; height:600px; margin: 1%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top: 5%; ">
           <ul >
            <li>All the vehicles listed are well maintained.<br>The documentations are as per the Motor Vehicle Act.</li>
            <li>The renter must provide the original Driving Licence at the reporting time. </li>   
            <li>Refuelling costs will be refunded back on submission of valid fuel receipt after the ride.</li>
            <li>The renter is liable for accident,theft and damage to the vehicle.</li> 
            <li>Rs10/km shall be added after the threshold kilometer is exceeded at the time of return. </li>
            <li>Speed governers and GPS have been implemented in every bike.</li>
            <li>The management is not responsible for any belongings after returning the bike.</li>
            </ul>
           <div class="btn">
               <input type="checkbox">I agree with the above rentals rules<br>
               <button class="btn1" type="submit">Order</button>
           </div>
        </div>
        <div class ="end">
            <p>Cities: Bengaluru  Mysuru  Vizag  Chennai  </p>
            <p>About Us:BikeRental team for public deployment </p>
            <p> © Copyright 2018 BikeRental India Private Ltd. All rights reserved. </p>
        </div>
    </body>
</html>