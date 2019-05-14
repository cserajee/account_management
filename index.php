<?PHP
session_start();
$_SESSION['acc_id']='';
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include('config.php');
if($_POST['submit']=='Login')
{ 
$acc_email=$_POST['acc_email']; 
$acc_password=$_POST['acc_password'];
$acc_email=addslashes($acc_email); 
$acc_password=addslashes($acc_password);
$acc_email = filter_var($acc_email, FILTER_SANITIZE_EMAIL); 
if (!filter_var($acc_email, FILTER_VALIDATE_EMAIL) === false && $acc_password) 
{
$result=mysqli_query($conn, "SELECT acc_id, acc_password FROM account_tb WHERE acc_email='$acc_email'");
if(mysqli_num_rows($result)==1)
{
$result = mysqli_fetch_array( $result ); 
$acc_id=$result[0];
$a_password=$result[1];
if($a_password==md5($acc_password))
{
$_SESSION['acc_id']=$acc_id;
header("location:dashboard.php");
}else 
$report='<br><div class="alert alert-danger">Invalid email and password...</div>';
}
else
$report='<br><div class="alert alert-danger">Invalid email and password...</div>';
}else
$report='<br><div class="alert alert-danger">Invalid email and password...</div>';
}
?>
<html>

<head>
 <title>Account</title>
 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<script>
 function validateForm(account)
{ 
if(validate_field(acc_email)==false)
return false; 
if(validate_field(password)==false)
return false;

}
function validate_field(field)
{
if (field.value==null || field.value=="")
{   
field.style.background='#FFD9D9';
field.focus();
return false;
}
else {
field.style.background='#FFFFFF';
return true
}
}
</script>

<body class="signin text-center">
 <form class="form-signin" method="post">
  <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="acc_email" name="acc_email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="acc_password" name="acc_password" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">Sign in</button>
  <?PHP echo $report; ?>
 </form>
</body>

</html>
