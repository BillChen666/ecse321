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

if(empty($_POST['staff_name']) || empty($_POST['progress']))
{
    $_SESSION['errorStaff']='Please fill in all the information';
    header("Location:lab.php");
    exit();
}

for($i = 0; $i < count($account->account[0]); $i++){
    $username = $account->account[0]->user[$i]->username;
    if(($user_details['username'] == $username)){
        if(empty($account->account[0]->user[$i]->staffs))
        {
            $staffs=$account->account[0]->user[$i]->addChild('staffs');
        }
        $staff=$account->account[0]->user[$i]->staffs[0]->addChild('staff');
        $staff->addChild('staff_name',$_POST['staff_name']);
        $staff->addChild('staff_role',$_POST['staff_role']);
        $staff->addChild('progress',$_POST['progress']);
        $account->asXML("../xml/account.xml");
        
        $_SESSION['staff_details'] = json_encode($account->account[0]->user[$i]->staffs[0]);
        header("Location:staff.php");
        exit();
    }
}


?>