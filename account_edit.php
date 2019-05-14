<?PHP
session_start();
if(!$_SESSION['acc_id']){
header("location:index.php");
}
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include('config.php');
if(sizeof($_POST['update'])>0)
{
$edit_row=$_POST['update'][0];
}
else if($_POST['submit']=='Update')
{
$acc_name=$_POST['acc_name'];
$acc_email=$_POST['acc_email'];
$edit_row=$_POST['edit_row'];
$acc_password=$_POST['acc_password'];
$acc_name=addslashes($acc_name);
$acc_email=addslashes($acc_email);
$edit_row=addslashes($edit_row);
$acc_password_update='';
if(trim($acc_password)){
$acc_password=addslashes($acc_password);
$acc_password=md5($acc_password);
$acc_password_update=",
acc_password= '$acc_password'";
}
$acc_email = filter_var($acc_email, FILTER_SANITIZE_EMAIL); 
if (!filter_var($acc_email, FILTER_VALIDATE_EMAIL) === false)
{ 
$sql = " UPDATE account_tb SET
acc_name= '$acc_name',
acc_email= '$acc_email'
$acc_password_update
WHERE 
acc_id='$edit_row'";
$result = mysqli_query($conn, $sql); 
if($result)
{
$report='<div class="alert alert-success">Account Updated...</div>';
}
}else
$report='<div class="alert alert-danger">Invalid Email...</div>';
}
else if(sizeof($_POST['delete'])>0)
{
$delete_row=$_POST['delete'][0]; 
if (filter_var($delete_row, FILTER_VALIDATE_INT) === 0 ||
 !filter_var($delete_row, FILTER_VALIDATE_INT) === false)
{
   $sql = " DELETE FROM account_tb  WHERE  acc_id ='$delete_row'";
   $result = mysqli_query($conn, $sql );
    if($result)
	{ 
    header("location:account_view.php?report=1");
	}
}
   
}

if($edit_row && is_numeric($edit_row)){
$result=mysqli_query($conn,"SELECT * FROM account_tb WHERE acc_id='$edit_row' ");
$row=mysqli_fetch_array($result);
$acc_id=$row['acc_id'];
$acc_name=$row['acc_name'];
$acc_email=$row['acc_email'];
}
if(!$acc_id) header("location:account_view.php");

?>
<html>

<head>
 <title>Account Edit</title>
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
     <h1 class="h2">Account - Edit</h1>
     <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
       <a href="account_add.php" class="btn btn-sm btn-outline-secondary">Add</a>
      </div>
     </div>
    </div>
    <div class="container">
     <div class="col-md-6">
      <form action="#" method="post" onSubmit="return validateForm(this)">
       <label for="acc_name">Name</label>
       <input type="text" name="acc_name" id="acc_name" Class="form-control" value="<?PHP echo $acc_name?>" />
       <label for="acc_email">Email</label>
       <input type="email" name="acc_email" id="acc_email" Class="form-control" value="<?PHP echo $acc_email?>" />
       <label for="acc_password">Password</label>
       <input type="password" name="acc_password" id="acc_password" class="form-control" />
       <br>
       <input type="hidden" name="edit_row" id="edit_row" class="form-control" value="<?PHP echo $acc_id?>" />
       <input type="submit" class="btn btn-success" name="submit" value="Update" />
       <a href="account_view.php" class="btn btn-info"> BACK </a>
      </form>
      <?PHP echo $report; ?>
     </div>
    </div>
   </main>
  </div>
 </div>
</body>

</html>
