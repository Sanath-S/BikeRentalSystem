<?php
 session_start();
    

$con = mysqli_connect('localhost', 'root', '', 'bike');

$query = "SELECT * from booking where status=0 ";
$result=mysqli_query($con, $query);

$i = 1; //counter for the checkboxes so that each has a unique name
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
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['bid'] . "</td>";
  echo "<td>" . $row['uid'] . "</td>";
  echo "<td>" . $row['vid'] . "</td>";
  echo "<td>" . $row['pdate'] . "</td>";
  echo "<td>" . $row['ddate'] . "</td>";
  echo "<td>" . $row['ptime'] . "</td>";
  echo "<td>" . $row['dtime'] . "</td>";
  echo "<td>" . $row['phone'] . "</td>";
  echo "<td><input type='checkbox' name='check[$i]' value='".$row['bid']."'/>";   
  echo "</tr>";
  $i++;
  }
echo "</table>";
echo "<input type='submit' name='approve' value='approve'/>";
echo "</form>";

mysqli_close($con);

?>




<?php

$anam=$_SESSION['aname'];

$con = mysqli_connect('localhost', 'root', '', 'bike');

// aid
$query="SELECT * from admin where aname='$anam'";
$result=mysqli_query($con,$query);
$row1 = mysqli_fetch_array($result);
$aid = $row1[0];

if(isset($_POST['approve'])){
                if(isset($_POST['check'])){
                    foreach ($_POST['check'] as $value){
                        $sql = "UPDATE booking SET status = 1 WHERE bid = $value"; 
                        mysqli_query($con, $sql);
                        
                        $sql1 = "UPDATE booking SET aid=$aid where bid=$value ";
                        $qry = mysqli_query($con, $sql1); 
                        


                    }
                }
            }

?>