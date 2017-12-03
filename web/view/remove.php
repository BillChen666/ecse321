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

$username='';
$staffname='';
$equipmetname='';
$supplyname='';

for($i = 0; $i < count($account->account[0]); $i++){
    $username = $account->account[0]->user[$i]->username;
    if(($user_details['username'] == $username)){
        if(!empty($_POST['staff_remove']))
        {
            
            for($j = 0; $j < count($account->account[0]->user[$i]->staffs[0]); $j++){
                $staffname = $account->account[0]->user[$i]->staffs[0]->staff[$j]->staff_name;
               // $equipmetname = $account->account[0]->user[$i]->equipments[0]->equipment[$j]->equipment_name;
               // $supplyname = $account->account[0]->user[$i]->supplies[0]->supply[$j]->supply_name;
                if($_POST['staff_remove']==$staffname)
                {
                    unset($account->account[0]->user[$i]->staffs[0]->staff[$j]);
                    $account->asXML("../xml/account.xml");
                    if(isset($_SESSION['staff_details']))
                    {
                      unset($_SESSION['staff_details']);  
                      $_SESSION['staff_details'] = json_encode($account->account[0]->user[$i]->staffs[0]);
                    }
                    header("Location:staff.php");
                    exit();
                }
            }
        }
        if(!empty($_POST['equipment_remove']))
        {
            
            for($j = 0; $j < count($account->account[0]->user[$i]->equipments[0]); $j++){
                $equipmentname = $account->account[0]->user[$i]->equipments[0]->equipment[$j]->equipment_name;
                if($_POST['equipment_remove']==$equipmentname)
                {
                    unset($account->account[0]->user[$i]->equipments[0]->equipment[$j]);
                    $account->asXML("../xml/account.xml");
                    if(isset($_SESSION['equipment_details']))
                    {
                        unset($_SESSION['equipment_details']);
                        $_SESSION['equipment_details'] = json_encode($account->account[0]->user[$i]->equipments[0]);
                    }
                    header("Location:equipment.php");
                    exit();
                }
            }
        }
        if(!empty($_POST['supply_remove']))
        {
            
            for($j = 0; $j < count($account->account[0]->user[$i]->supplies[0]); $j++){
                $supplyname = $account->account[0]->user[$i]->supplies[0]->supply[$j]->supply_name;
                if($_POST['supply_remove']==$supplyname)
                {
                    unset($account->account[0]->user[$i]->supplies[0]->supply[$j]);
                    $account->asXML("../xml/account.xml");
                    if(isset($_SESSION['supply_details']))
                    {
                        unset($_SESSION['supply_details']);
                        $_SESSION['supply_details'] = json_encode($account->account[0]->user[$i]->supplies[0]);
                    }
                    header("Location:supply.php");
                    exit();
                }
            }
        }
        
    }
}
?>