
<!DOCTYPE html>
<html>
<head>
<title> Booking </title>   
    <link rel="stylesheet"  href="details.css">
</head>
<body>




    <div id="outerbox">
      <div class="box">
        <h1> Booking Credentials</h1><br>
        
        <form method="POST" action="booking.php">  
          <ol style="list-style-type:none">
          <h5>Details</h5>
          <li><input type="text" name="phone" placeholder="Phone"/></li>
         
         <h5>Pickupdate & Time</h5>
         <li> <input type="date" name="pdate" placeholder="Pickupdate: yyyy/mm/dd"/></li>
        
         <li> <input type="time" name="ptime" placeholder="Pickuptime: hr:min(24hrs)"/></li>
         <h5>Dropdate & Time</h5>
          <input type="date" name="ddate" placeholder="Dropdate: yyyy/mm/dd"/><br>
          

           <input type="time" name="dtime" placeholder="Droptime: hr:min"/><br>
                <br> <i>(All Fields Are Mandatory)</i><br><br>
               <button type="submit" class="btn" name="booking_details" >Confirm</button>
            <ol>
        </form>       
      </div>
        
        
    </div>
        
  

</body>    
</html>