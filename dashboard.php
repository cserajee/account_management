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
 <title>Dashboard</title>
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
     <h1 class="h2">Dashboard</h1>

    </div>
    <p class="lead">Welcome to Techdasher.</p>

   </main>
  </div>
 </div>
</body>

</html>
