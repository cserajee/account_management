<?PHP
session_start();
if(!$_SESSION['acc_id']){
header("location:index.php");
}
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
?>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
 <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Techdasher</a>
 <ul class="navbar-nav px-3">
  <li class="nav-item text-nowrap">
   <a class="nav-link" href="index.php">Sign out</a>
  </li>
 </ul>
</nav>
