<?php
   $con = mysqli_connect("localhost","nexusuvx_nexus",'VbYD%$Rhq&s5',"nexusuvx_player11");

   // Check connection
   if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   } else {
      echo "Connected";
   }
?>