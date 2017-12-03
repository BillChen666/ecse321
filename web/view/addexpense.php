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

if(empty($_POST['reason']) || empty($_POST['amount']))
{
    $_SESSION['errorExpense']='Please fill in all the information';
    header("Location:lab.php");
    exit();
}

for($i = 0; $i < count($account->account[0]); $i++){
    $username = $account->account[0]->user[$i]->username;
    if(($user_details['username'] == $username)){
        if(empty($account->account[0]->user[$i]->expenses))
        {
            $expenses=$account->account[0]->user[$i]->addChild('expenses');
        }
        $expense=$account->account[0]->user[$i]->expenses[0]->addChild('expense');
        $expense->addChild('reason',$_POST['reason']);
        $expense->addChild('amount',$_POST['amount']);
        $account->asXML("../xml/account.xml");
        
        $budget=$account->account[0]->user[$i]->budget+$_POST['amount'];
        $account->account[0]->user[$i]->budget=$budget;
        
        if(isset($_SESSION['user_details']) && !empty($_SESSION['user_details']))
        {
            unset($_SESSION['user_details']);
            $_SESSION['user_details'] = json_encode($account->account[0]->user[$i]);
        }
        
        $_SESSION['expense_details'] = json_encode($account->account[0]->user[$i]->expenses[0]);
        header("Location:expense.php");
        exit();
    }
}


?>