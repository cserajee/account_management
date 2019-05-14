<?PHP
session_start();
if(!$_SESSION['acc_id']){
header("location:index.php");
}
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
?>
<!-- <div class="col-lg-10 text-right"><a href="account_add.php">Add</a> | <a href="account_view.php">Edit</a> | <a href="index.php">Logout</a></div> -->

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
 <div class="sidebar-sticky">
  <ul class="nav flex-column">
   <li class="nav-item">
    <a class="nav-link" href="dashboard.php">
     Dashboard
    </a>
   </li>
   <li class="nav-item">
    <a class="nav-link" href="account_view.php">
     Account
    </a>
   </li>


  </ul>

 </div>
</nav>
