<?PHP
session_start();
if(!$_SESSION['acc_id']){
header("location:index.php");
}
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include('config.php');
?>
<html>

<head>
 <title>Account</title>
 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
 <?PHP require_once("nav.php") ?>
 <div class="container-fluid">
  <div class="row">
   <?PHP require_once("menu.php") ?>
   <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Account</h1>
     <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
       <a href="account_add.php" class="btn btn-sm btn-outline-secondary">Add</a>
      </div>
     </div>
    </div>
    <div class="container">
     <div class="col-md-8">
      <form action="account_edit.php" method="post" onSubmit="return validateForm(this)">
       <table class="table table-striped">
        <thead>
         <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
        </thead>
        <tbody>
         <?PHP
         $result=mysqli_query($conn,"SELECT * FROM account_tb");
         $counter=0;
         while($row=mysqli_fetch_array($result))
         {
         $acc_id=$row['acc_id'];
         $acc_name=$row['acc_name'];
         $acc_email=$row['acc_email'];  
         $acc_id=stripslashes($acc_id);
         $acc_name=stripslashes($acc_name);
         $acc_email=stripslashes($acc_email); 

         echo '<tr>
         <td>'.(++$counter).'</td>
         <td>'.$acc_name.'</td>
         <td>'.$acc_email.'</td>
         <td><button type="submit" class="btn btn-primary" name="update[]" value="'.$acc_id.'">Update</button></td>
         <td><button type="submit" class="btn btn-danger" name="delete[]" value="'.$acc_id.'">Delete</button></td>
         </tr>';
         }
       ?>
        </tbody>
       </table>
      </form>
      <?PHP  if($_REQUEST['report']==1) echo '<div class="alert alert-success">Account Deleted....</div>'; ?>
     </div>
    </div>
   </main>
  </div>
 </div>


</body>

</html>
