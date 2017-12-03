<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
#loginpanel {
position:absolute;
left:800px;
top:200px;
font-size:60px;
}
#picture {
position:absolute;
left:50px;
top:600px;
}
</style>
</head>
<body background="../imgsrc/321-2.png">
<?php
require_once __DIR__.'/../controller/InputValidator.php';
require_once __DIR__.'/../model/Equipment.php';
require_once __DIR__.'/../model/Expense.php';
require_once __DIR__.'/../model/Lab.php';
require_once __DIR__.'/../model/Staff.php';
require_once __DIR__.'/../model/Supply.php';
require_once __DIR__.'/../model/URLMS.php';
require_once __DIR__.'/../persistence/PersistenceLabManagement.php';
session_start();
if(isset($_SESSION['login']) && $_SESSION['login']==true){
    header("Location:lab.php");
    exit();
}
?>
<form name="form1" method="post" action="checklogin.php">
<div id="loginpanel">
<img src="../imgsrc/321-1.jpg" style="width:480px;height:270px;"></img><br/>
Username&nbsp;&nbsp;<input  type="text" name="username" style="height:40px"></input><br/>
<br/>
Password&nbsp;&nbsp;<input  type="password" name="password" style="height:40px"></input><br/>
<br/>
<input type="submit" value="login" style="height:100px;width:200px"></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type ="button" value="New Account" onclick="window.location.href='register.php'" style="height:100px;width:200px"></input>
<br/>
<?php 
if (isset ( $_SESSION ['errorItem'] ) && ! empty ( $_SESSION ['errorItem'] ))
{
    echo " * " . $_SESSION ['errorItem'];
}
?>
</div>
</form>
<div id="picture">
<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
</div>
</body>
</html>
<?php 
unset($_SESSION['errorItem']);
?>