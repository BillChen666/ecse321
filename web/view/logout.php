<?php
session_start();
if (isset ( $_SESSION ['login'] ) && ! empty ( $_SESSION ['login'] ))
{
    $_SESSION['login']=false;
    $_SESSION['user_details']=false;
    header("Location:index.php");
    exit(); 
}
?>