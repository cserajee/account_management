<?PHP
session_start();
if(!$_SESSION['acc_id']){
header("location:index.php");
}
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include('config.php');
if($_POST['submit']=='Submit')
{
$acc_name=$_POST['acc_name'];
$acc_email=$_POST['acc_email']; 
$acc_password=$_POST['acc_password'];

$acc_name=addslashes($acc_name);
$acc_email=addslashes($acc_email); 
$acc_password=addslashes($acc_password);
$acc_password=md5($acc_password);
$acc_email = filter_var($acc_email, FILTER_SANITIZE_EMAIL); 
if (!filter_var($acc_email, FILTER_VALIDATE_EMAIL) === false)
{
$sql="SELECT acc_id FROM account_tb WHERE acc_email='$acc_email'";
if(mysqli_num_rows(mysqli_query($conn, $sql))==0)
{
   $sql = " INSERT INTO account_tb (acc_name, acc_email, acc_password, created_dt) VALUES  ( '$acc_name', '$acc_email', '$acc_password', now()) ";
   $result = mysqli_query($conn, $sql); 
   if($result)
   {
    $report='<div class="alert alert-success">Account Created...</div>';
   }
}
else
$report='<div class="alert alert-danger">Email Already Exists...</div>';
}else
$report='<div class="alert alert-danger">Invalid Email...</div>';
}
?>
<html>

<head>
 <title>Account Add</title>
 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<script>
 function validateForm(account)
{
if(validate_field(acc_name)==false)
return false;
if(validate_field(acc_email)==false)
return false; 
if(validate_field(acc_password)==false)
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

<body>
 <?PHP require_once("nav.php") ?>
 <div class="container-fluid">
  <div class="row">
   <?PHP require_once("menu.php") ?>
   <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Account - Add</h1>
     <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
       <a href="account_view.php" class="btn btn-sm btn-outline-secondary">Edit</a>
      </div>
     </div>
    </div>
    <div class="container">
     <div class="col-md-6">
      <form action="#" method="post" class="submit-form" onSubmit="return validateForm(this)">
       <label for="acc_name">Name</label>
       <input type="text" name="acc_name" id="acc_name" Class="form-control" />
       <label for="acc_email">Email</label>
       <input type="email" name="acc_email" id="acc_email" Class="form-control" />
       <label for="acc_password">Password</label>
       <input type="password" name="acc_password" id="acc_password" class="form-control" />
       <br>
       <input type="submit" class="btn btn-success" name="submit" value="Submit" />
      </form>
      <?PHP echo $report; ?>
     </div>
    </div>
   </main>
  </div>
 </div>
</body>

</html>
