<?php
session_start();
if (isset ( $_SESSION ['user_details'] ) && ! empty ( $_SESSION ['user_details'] ))
{
    $user_details=json_decode($_SESSION['user_details'],true);
}
else {
    $_SESSION['errorItem']='Do not have lab';
    header("Location:lab.php");
    exit();
}

$url="../xml/account.xml";
$account=new SimpleXMLElement(file_get_contents($url));

$username = "";

if(empty($_POST['supply_name']) || empty($_POST['supply_quantity']))
{
    $_SESSION['errorSupply']='Please fill in all the information';
    header("Location:lab.php");
    exit();
}

for($i = 0; $i < count($account->account[0]); $i++){
    $username = $account->account[0]->user[$i]->username;
    if(($user_details['username'] == $username)){
        if(empty($account->account[0]->user[$i]->supplies))
        {
            $supplies=$account->account[0]->user[$i]->addChild('supplies');
        }
        $supply=$account->account[0]->user[$i]->supplies[0]->addChild('supply');
        $supply->addChild('supply_name',$_POST['supply_name']);
        $supply->addChild('supply_quantity',$_POST['supply_quantity']);
        $account->asXML("../xml/account.xml");
        
        $_SESSION['supply_details'] = json_encode($account->account[0]->user[$i]->supplies[0]);
        header("Location:supply.php");
        exit();
    }
}


?>