<?php
session_start();
$accountdata = simplexml_load_file("../xml/account.xml");

$username = "";
$password = "";

for($i = 0; $i < count($accountdata->account[0]); $i++){
    
    $username = $accountdata->account[0]->user[$i]->username;
    $password = $accountdata->account[0]->user[$i]->password;

    
    if(empty($_POST['username']) || empty($_POST['password']))
    {
        $_SESSION['errorItem']='Please fill in both username and password';
        header("Location:index.php");
        exit();
    }
     
    
    if(($_POST['username'] == $username) && ($_POST['password'] == $password)){
        //set logged in
        $_SESSION['login'] = true;
        //unset password no need to include that
        unset($accountdata->account[0]->user[$i]->password);
        
        //json encode the user stuff from the xml
        $_SESSION['user_details'] = json_encode($accountdata->account[0]->user[$i]);
        
        //goto admin
        header("Location:lab.php");
        exit();
    } 
}

if(!$_SESSION['login']){
    $_SESSION['errorItem']='Wrong password or username';
    header("Location:index.php");
    exit();
} 
?>