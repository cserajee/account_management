<?php   
   $db_hostname = 'localhost';
   $db_name = 'account';
   $db_username = 'root';
   $db_password = '';
   $conn = mysqli_connect($db_hostname, $db_username, $db_password); 
   if(! $conn )
   {
      die('Could not connect: ' . mysqli_error());
   }    
   $db = mysqli_select_db($conn, $db_name); 
?>
