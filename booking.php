<?php
    session_start();

    $phone="";
    $pdate="";
    $ddate="";
    $ptime="";
    $dtime="";
    $user=$_SESSION['username'];
    $veh=$_SESSION['vehicle'];
   
    
    $db = mysqli_connect('localhost', 'root', '', 'bike');
	
	 $bid = mt_rand(10001,99999);
    $_SESSION['booking'] = $bid;

    //fetch single value from database
    $query="SELECT id from users where username='$user'";
    $result=mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    $uid = $row[0];
    
    //vid
    $query="SELECT * from vehicles where vid='$veh'";
    $result=mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    $vid = $row[0];

    if (isset($_POST['booking_details'])) {
        // receive all input values from the form
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $pdate = mysqli_real_escape_string($db, $_POST['pdate']);
        $ddate = mysqli_real_escape_string($db, $_POST['ddate']);
        $ptime = mysqli_real_escape_string($db, $_POST['ptime']);
        $dtime = mysqli_real_escape_string($db, $_POST['dtime']);
    }

    $time_pick = strtotime($pdate.$ptime);
	$time_drop = strtotime($ddate.$dtime);
    $hours = round((($time_drop) - ($time_pick)) / 3600);
    
     $querry = "INSERT into booking (bid,uid,vid,pdate,ddate,ptime,dtime,phone,hours,status) 
        VALUES('$bid','$uid','$vid','$pdate','$ddate','$ptime','$dtime','$phone','$hours',0)";
    mysqli_query($db, $querry);

    $qury = "SELECT phr FROM type WHERE tid in (SELECT tid from vehicles where vid=$vid)";
    $res = mysqli_query($db,$qury);
    $row = mysqli_fetch_array($res);
    $cost_phr = $row[0];
    echo $cost_phr;

    // $sql = "CALL 'cost_calc'(?, ?, ?, @cst)";
    $stmt = $db->prepare('CALL cost_calc(?, ?, ?, @cst)');

    $stmt->bind_param('iii', $cost_phr, $hours, $bid);
    // // $stmt->execute();
    // $stmt->bindParam("hours", $hours);
    // // $stmt->execute();
    // $stmt->bindParam("bid", $bid);
    $stmt->execute();

    $sql = "SELECT @cst AS `cost`";
    $stmt = $db->prepare($sql);
    $stmt->execute();




    $sql1 = "UPDATE vehicles SET status=1 where vid=$vid ";
                        $qry = mysqli_query($db, $sql1); 

                        header("Location:summary.php");
                        
?>
