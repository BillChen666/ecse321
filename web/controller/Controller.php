<?php
require_once __DIR__.'/InputValidator.php';
require_once __DIR__.'/../model/Equipment.php';
require_once __DIR__.'/../model/Expense.php';
require_once __DIR__.'/../model/Lab.php';
require_once __DIR__.'/../model/Staff.php';
require_once __DIR__.'/../model/Supply.php';
require_once __DIR__.'/../model/URLMS.php';
require_once __DIR__.'/../persistence/PersistenceLabManagement.php';

class Controller
{
    public function __construct()
    {
        
    }
    public function createStaff($staff_name,$progess,$index)
    {
        $URLMS=URLMS::getInstance(); 
        $name = InputValidator::validate_input($staff_name);
        $progess=InputValidator::validate_input($progess);
        $index=InputValidator::validate_input($index);
        $lab=$URLMS->getLab_index($index);
        if(name==null||strlen($name)==0)
        {
            throw new Exception("name can not be empty");
        }
        else if ($progess<0)
        {
            throw new Exception("progress can not be negative");
        }
        else 
        {
        $ptl = new PersistenceLabManagement();       
        $Lm = $ptl->loadDataFromStore();          
        $staff = new Staff($name, $progess, $lab);    
        $Lm->getLab_index($index)->addStaff($aStaff);
        //Write data    
        $ptl->writeDataToStore($Lm);
        }
    } 
    public function createLab($username,$password,$accountbalance)
    {
        $URLMS=URLMS::getInstance(); 
        $username = InputValidator::validate_input($username);
        $password=InputValidator::validate_input($password);
        $balance=InputValidator::validate_input($accountbalance);
        if($username==0||strlen($username)==null)
        {
            throw new Exception("username can not be empty");
        }
        else if(strlen($password)<6)
        {
            throw new Exception("password should have more than 6 charactors");
        }
        else if($accountbalance<0)
        {
            throw new Exception("accoutbalacne can not be negative");
        }
        else
        {
            $ptl=new PersistenceLabManagement();
            $Lm=$ptl->loadDateFromStore();
            $lab=new Lab($username, $password, $accountbalance, $URLMS);
            $number=$Lm->numberOfLab()+1;
            $Lm->addLabAt($lab, $number);
            $ptl->writeDataToStore($Lm);
        }  
    }
    public function createExpense($reason,$amount,$index)
    {
        $URLMS=URLMS::getInstance();
        $reason = InputValidator::validate_input($reason);
        $amount=InputValidator::validate_input($amount);
        $index=InputValidator::validate_input($index);
        $lab=$URLMS->getLab_index($index);
        if(reason==null||strlen($name)==0)
        {
            throw new Exception("reason can not be empty");
        }
        else if($amount<0)
        {
            throw new Exception("amount can not be nagetive");
        }
        else
        {
            $ptl = new PersistenceLabManagement();
            $Lm = $ptl->loadDataFromStore();
            $expense = new Expense($reason,$amount,$lab); 
            $Lm->getLab_index($index)->addExpense($expense);
            //Write data
            $ptl->writeDataToStore($Lm);
        }
    } 
    public function login($username,$password)
    {
        $URLMS=URLMS::getInstance();
        $username=InputValidator::validate_input($username);
        $password=InputValidator::validate_input($password);
        $ptl = new PersistenceLabManagement();
        $Lm = $ptl->loadDataFromStore();
        if(strlen($username)==null)
        {
            throw new Exception("username is empty");
        }
        foreach ($Lm->getLab() as $lab)
        {
            if($username==$lab->getUsername())
            {
                if($password==$lab->getPassword())
                {
                    $ptl->writeDataToStore($Lm);
                    return $lab->getId();
                }
                else break;
            }
        }
        $ptl->writeDataToStore($Lm);
        throw new Exception("Incorrect username or password");
    }
    public function createEquipment($equipment_name,$equipment_quantity,$index)
    {
        $URLMS=URLMS::getInstance();
        $name = InputValidator::validate_input($equipment_name);
        $quantity=InputValidator::validate_input($equipment_quantity);
        $index=InputValidator::validate_input($index);
        $lab=$URLMS->getLab_index($index);
        if(name==null||strlen($name)==0)
        {
            throw new Exception("name can not be empty");
        }
        else if ($quantity<0)
        {
            throw new Exception("quantity can not be negative");
        }
        else
        {
            $ptl = new PersistenceLabManagement();
            $Lm = $ptl->loadDataFromStore();
            $equipment = new Equipment($name, $quantity, $lab);
            $Lm->getLab_index($index)->addEquipment($equipment);
            //Write data
            $ptl->writeDataToStore($Lm);
        }
    }
    public function createSupply($supply_name,$supply_quantity,$index)
    {
        $URLMS=URLMS::getInstance();
        $name = InputValidator::validate_input($supply_name);
        $quantity=InputValidator::validate_input($supply_quantity);
        $index=InputValidator::validate_input($index);
        $lab=$URLMS->getLab_index($index);
        if(name==null||strlen($name)==0)
        {
            throw new Exception("name can not be empty");
        }
        else if ($quantity<0)
        {
            throw new Exception("quantity can not be negative");
        }
        else
        {
            $ptl = new PersistenceLabManagement();
            $Lm = $ptl->loadDataFromStore();
            $supply = new Supply($name, $quantity, $lab);
            $Lm->getLab_index($index)->addSupply($supply);
            //Write data
            $ptl->writeDataToStore($Lm);
        }
    }
}
?>
