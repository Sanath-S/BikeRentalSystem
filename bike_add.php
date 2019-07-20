
<?php

    session_start();

    // initializing variables
        $vname = "";
        $type = "";
        $engine = "";
        $speed = "";
        $power = "";
        $admin = $_SESSION['aname'];



    $connection = mysqli_connect("localhost", "root", "", "bike");

    if(isset($_POST['fileuploadsubmit'])) {

        //aid
        $query="SELECT aid from admin where aname='$admin'";
        $result=mysqli_query($connection,$query);
        $row = mysqli_fetch_array($result);
        $aid = $row[0];
        
        
        $vname = mysqli_real_escape_string($connection, $_POST['vname']);
        $type = mysqli_real_escape_string($connection, $_POST['type']);
        $engine = mysqli_real_escape_string($connection, $_POST['engine']);
        $power = mysqli_real_escape_string($connection, $_POST['power']);
        $speed = mysqli_real_escape_string($connection, $_POST['speed']);


        $fileupload = $_FILES['fileupload']['name'];
        $fileuploadTMP = $_FILES['fileupload']['tmp_name'];
        $folder = "/pics";

        move_uploaded_file($fileuploadTMP, $folder.$fileupload);

        $sql = "INSERT INTO vehicles(tid,aid,vname,engine,speed,power,image,status) 
        VALUES('$type',$aid,'$vname',$engine,$speed,$power,'$fileupload',0)";

        $qry = mysqli_query($connection, $sql);
        

            if ($qry) {

                echo "uploaded";

            }
    }

?>


<!DOCTYPE html>
<html>
<body>
<form method="post" action="" enctype="multipart/form-data">

<div class="input-group">
  		<label>Vehicle name</label>
  		<input type="text" name="vname" >
  	</div>
      <div>
      <select name="type" multiple> // Initializing Name With An Array
        <option value="1">with gear</option>
        <option value="2">with-out gear</option>
        <option value="3">with gear premium</option>
        <option value="4">cycle</option>
    </select>
    </div>
      <div class="input-group">
  		<label>Engine</label>
  		<input type="text" name="engine" placeholder="in CC"/>
  	</div>
      <div class="input-group">
  		<label>Speed</label>
  		<input type="text" name="speed" placeholder="in kmph"/ >
  	</div>  
      <div class="input-group">
  		<label>Power</label>
  		<input type="text" name="power" placeholder="in Hp"/ >
  	</div>    

<input type="file" name="fileupload" />
<input type="submit" name="fileuploadsubmit" />
</form>
</body>
</html>