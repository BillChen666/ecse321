<?php 
session_start();
$url="../xml/account.xml";
$account=new SimpleXMLElement(file_get_contents($url));

if(empty($_POST['username']) || empty($_POST['password'])||empty($_POST['budget']))
{
    $_SESSION['errorItem']='Please fill in all the information';
    header("Location:register.php");
    exit();
}


$user=$account->account[0]->addChild('user');
$user->addChild('username',$_POST['username']);
$user->addChild('budget',$_POST['budget']);
$user->addChild('password',$_POST['password']);

$account->asXML("../xml/account.xml");
header("Location:index.php");
exit();
?>