<?PHP
   $db_hostname = 'localhost'; 
   $db_username = 'root';
   $db_password = '';
   $conn = mysqli_connect($db_hostname, $db_username, $db_password); 
   $sql = 'CREATE Database account';
   $result = mysqli_query($conn, $sql);
   if($result )  {
   echo 'DB Created<br>';
   $result = mysqli_select_db($conn, 'account');
    $sql = ' CREATE TABLE account_tb(acc_id INT(20) NOT NULL AUTO_INCREMENT, acc_name VARCHAR(155) NOT NULL, acc_email  VARCHAR(155) NOT NULL, acc_password   VARCHAR(155) NOT NULL,  created_dt DATETIME NOT NULL, status INT(1) NOT NULL DEFAULT "1", primary key ( acc_id )) ';
   $result = mysqli_query( $conn, $sql );
   echo 'Table Created';
    
   $sql = " INSERT INTO `account_tb` (`acc_id`, `acc_name`, `acc_email`, `acc_password`,  `status`) VALUES
    (1, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3',   1) ";
    $result = mysqli_query( $conn, $sql );
   echo 'Seed Created';
    
   } 
    mysqli_close($conn);
?>
