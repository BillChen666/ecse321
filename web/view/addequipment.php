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

if(empty($_POST['equipment_name']) || empty($_POST['quantity']))
{
    $_SESSION['errorEquipment']='Please fill in all the information';
    header("Location:lab.php");
    exit();
}

for($i = 0; $i < count($account->account[0]); $i++){
    $username = $account->account[0]->user[$i]->username;
    if(($user_details['username'] == $username)){
        if(empty($account->account[0]->user[$i]->equipments))
        {
            $equipments=$account->account[0]->user[$i]->addChild('equipments');
        }
        $equipment=$account->account[0]->user[$i]->equipments[0]->addChild('equipment');
        $equipment->addChild('equipment_name',$_POST['equipment_name']);
        $equipment->addChild('equipment_quantity',$_POST['quantity']);
        $account->asXML("../xml/account.xml");
        
        $_SESSION['equipment_details'] = json_encode($account->account[0]->user[$i]->equipments[0]);
        header("Location:equipment.php");
        exit();
    }
}


?>