<?php
    session_start();

    $s = "Approved";
    $n = "Pending for approval";
    $user = $_SESSION['username'];
    
    $con = mysqli_connect('localhost', 'root', '', 'bike');

    //fetch single value from database
    $querry = "SELECT id from users where username='$user'";
    $result1 = mysqli_query($con,$querry);
    $row = mysqli_fetch_array($result1);
    $uid = $row[0];

    $query = "SELECT * from booking where uid=$uid";
    $result = mysqli_query($con, $query);

    echo "<form action='admin_approval.php' method='post'>"; 
    echo "<table border='1'>
    <tr>
    <th>BID</th>
    <th>UID</th>
    <th>VID</th>
    <th>pick-up date</th>
    <th>drop date</th>
    <th>pick-up time</th>
    <th>drop time</th>
    <th>phone</th>
    <th>status</th>
    </tr>";

    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['bid'] . "</td>";
        echo "<td>" . $row['uid'] . "</td>";
        echo "<td>" . $row['vid'] . "</td>";
        echo "<td>" . $row['pdate'] . "</td>";
        echo "<td>" . $row['ddate'] . "</td>";
        echo "<td>" . $row['ptime'] . "</td>";
        echo "<td>" . $row['dtime'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";

        if( $row['status'] == "1" ){
            echo "<td>" . $s . "</td>";
        }
        else {
        echo "<td>" . $n . "</td>";
        }
        echo "</tr>";
    }
?>