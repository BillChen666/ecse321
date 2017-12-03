<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.26.0-b05b57321 modeling language!*/

class Lab
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static $nextId = 1;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Lab Attributes
  private $username;
  private $password;
  private $accountBalance;

  //Autounique Attributes
  private $id;

  //Lab Associations
  private $staffs;
  private $equipments;
  private $supplies;
  private $expenses;
  private $uRLMS;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aUsername, $aPassword, $aAccountBalance, $aURLMS)
  {
    $this->username = $aUsername;
    $this->password = $aPassword;
    $this->accountBalance = $aAccountBalance;
    $this->id = self::$nextId++;
    $this->staffs = array();
    $this->equipments = array();
    $this->supplies = array();
    $this->expenses = array();
    $didAddURLMS = $this->setURLMS($aURLMS);
    if (!$didAddURLMS)
    {
      throw new Exception("Unable to create lab due to uRLMS");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setUsername($aUsername)
  {
    $wasSet = false;
    $this->username = $aUsername;
    $wasSet = true;
    return $wasSet;
  }

  public function setPassword($aPassword)
  {
    $wasSet = false;
    $this->password = $aPassword;
    $wasSet = true;
    return $wasSet;
  }

  public function setAccountBalance($aAccountBalance)
  {
    $wasSet = false;
    $this->accountBalance = $aAccountBalance;
    $wasSet = true;
    return $wasSet;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getAccountBalance()
  {
    return $this->accountBalance;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getStaff_index($index)
  {
    $aStaff = $this->staffs[$index];
    return $aStaff;
  }

  public function getStaffs()
  {
    $newStaffs = $this->staffs;
    return $newStaffs;
  }

  public function numberOfStaffs()
  {
    $number = count($this->staffs);
    return $number;
  }

  public function hasStaffs()
  {
    $has = $this->numberOfStaffs() > 0;
    return $has;
  }

  public function indexOfStaff($aStaff)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->staffs as $staff)
    {
      if ($staff->equals($aStaff))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getEquipment_index($index)
  {
    $aEquipment = $this->equipments[$index];
    return $aEquipment;
  }

  public function getEquipments()
  {
    $newEquipments = $this->equipments;
    return $newEquipments;
  }

  public function numberOfEquipments()
  {
    $number = count($this->equipments);
    return $number;
  }

  public function hasEquipments()
  {
    $has = $this->numberOfEquipments() > 0;
    return $has;
  }

  public function indexOfEquipment($aEquipment)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->equipments as $equipment)
    {
      if ($equipment->equals($aEquipment))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getSupply_index($index)
  {
    $aSupply = $this->supplies[$index];
    return $aSupply;
  }

  public function getSupplies()
  {
    $newSupplies = $this->supplies;
    return $newSupplies;
  }

  public function numberOfSupplies()
  {
    $number = count($this->supplies);
    return $number;
  }

  public function hasSupplies()
  {
    $has = $this->numberOfSupplies() > 0;
    return $has;
  }

  public function indexOfSupply($aSupply)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->supplies as $supply)
    {
      if ($supply->equals($aSupply))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getExpense_index($index)
  {
    $aExpense = $this->expenses[$index];
    return $aExpense;
  }

  public function getExpenses()
  {
    $newExpenses = $this->expenses;
    return $newExpenses;
  }

  public function numberOfExpenses()
  {
    $number = count($this->expenses);
    return $number;
  }

  public function hasExpenses()
  {
    $has = $this->numberOfExpenses() > 0;
    return $has;
  }

  public function indexOfExpense($aExpense)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->expenses as $expense)
    {
      if ($expense->equals($aExpense))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getURLMS()
  {
    return $this->uRLMS;
  }

  public static function minimumNumberOfStaffs()
  {
    return 0;
  }

  public function addStaffVia($aName, $aProgress)
  {
    return new Staff($aName, $aProgress, $this);
  }

  public function addStaff($aStaff)
  {
    $wasAdded = false;
    if ($this->indexOfStaff($aStaff) !== -1) { return false; }
    $existingLab = $aStaff->getLab();
    $isNewLab = $existingLab != null && $this !== $existingLab;
    if ($isNewLab)
    {
      $aStaff->setLab($this);
    }
    else
    {
      $this->staffs[] = $aStaff;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeStaff($aStaff)
  {
    $wasRemoved = false;
    //Unable to remove aStaff, as it must always have a lab
    if ($this !== $aStaff->getLab())
    {
      unset($this->staffs[$this->indexOfStaff($aStaff)]);
      $this->staffs = array_values($this->staffs);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  public function addStaffAt($aStaff, $index)
  {  
    $wasAdded = false;
    if($this->addStaff($aStaff))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfStaffs()) { $index = $this->numberOfStaffs() - 1; }
      array_splice($this->staffs, $this->indexOfStaff($aStaff), 1);
      array_splice($this->staffs, $index, 0, array($aStaff));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveStaffAt($aStaff, $index)
  {
    $wasAdded = false;
    if($this->indexOfStaff($aStaff) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfStaffs()) { $index = $this->numberOfStaffs() - 1; }
      array_splice($this->staffs, $this->indexOfStaff($aStaff), 1);
      array_splice($this->staffs, $index, 0, array($aStaff));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addStaffAt($aStaff, $index);
    }
    return $wasAdded;
  }

  public static function minimumNumberOfEquipments()
  {
    return 0;
  }

  public function addEquipmentVia($aName, $aQuantity)
  {
    return new Equipment($aName, $aQuantity, $this);
  }

  public function addEquipment($aEquipment)
  {
    $wasAdded = false;
    if ($this->indexOfEquipment($aEquipment) !== -1) { return false; }
    $existingLab = $aEquipment->getLab();
    $isNewLab = $existingLab != null && $this !== $existingLab;
    if ($isNewLab)
    {
      $aEquipment->setLab($this);
    }
    else
    {
      $this->equipments[] = $aEquipment;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeEquipment($aEquipment)
  {
    $wasRemoved = false;
    //Unable to remove aEquipment, as it must always have a lab
    if ($this !== $aEquipment->getLab())
    {
      unset($this->equipments[$this->indexOfEquipment($aEquipment)]);
      $this->equipments = array_values($this->equipments);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  public function addEquipmentAt($aEquipment, $index)
  {  
    $wasAdded = false;
    if($this->addEquipment($aEquipment))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfEquipments()) { $index = $this->numberOfEquipments() - 1; }
      array_splice($this->equipments, $this->indexOfEquipment($aEquipment), 1);
      array_splice($this->equipments, $index, 0, array($aEquipment));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveEquipmentAt($aEquipment, $index)
  {
    $wasAdded = false;
    if($this->indexOfEquipment($aEquipment) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfEquipments()) { $index = $this->numberOfEquipments() - 1; }
      array_splice($this->equipments, $this->indexOfEquipment($aEquipment), 1);
      array_splice($this->equipments, $index, 0, array($aEquipment));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addEquipmentAt($aEquipment, $index);
    }
    return $wasAdded;
  }

  public static function minimumNumberOfSupplies()
  {
    return 0;
  }

  public function addSupplyVia($aName, $aQuantity)
  {
    return new Supply($aName, $aQuantity, $this);
  }

  public function addSupply($aSupply)
  {
    $wasAdded = false;
    if ($this->indexOfSupply($aSupply) !== -1) { return false; }
    $existingLab = $aSupply->getLab();
    $isNewLab = $existingLab != null && $this !== $existingLab;
    if ($isNewLab)
    {
      $aSupply->setLab($this);
    }
    else
    {
      $this->supplies[] = $aSupply;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeSupply($aSupply)
  {
    $wasRemoved = false;
    //Unable to remove aSupply, as it must always have a lab
    if ($this !== $aSupply->getLab())
    {
      unset($this->supplies[$this->indexOfSupply($aSupply)]);
      $this->supplies = array_values($this->supplies);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  public function addSupplyAt($aSupply, $index)
  {  
    $wasAdded = false;
    if($this->addSupply($aSupply))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfSupplies()) { $index = $this->numberOfSupplies() - 1; }
      array_splice($this->supplies, $this->indexOfSupply($aSupply), 1);
      array_splice($this->supplies, $index, 0, array($aSupply));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveSupplyAt($aSupply, $index)
  {
    $wasAdded = false;
    if($this->indexOfSupply($aSupply) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfSupplies()) { $index = $this->numberOfSupplies() - 1; }
      array_splice($this->supplies, $this->indexOfSupply($aSupply), 1);
      array_splice($this->supplies, $index, 0, array($aSupply));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addSupplyAt($aSupply, $index);
    }
    return $wasAdded;
  }

  public static function minimumNumberOfExpenses()
  {
    return 0;
  }

  public function addExpenseVia($aReason, $aAmountPaid)
  {
    return new Expense($aReason, $aAmountPaid, $this);
  }

  public function addExpense($aExpense)
  {
    $wasAdded = false;
    if ($this->indexOfExpense($aExpense) !== -1) { return false; }
    $existingLab = $aExpense->getLab();
    $isNewLab = $existingLab != null && $this !== $existingLab;
    if ($isNewLab)
    {
      $aExpense->setLab($this);
    }
    else
    {
      $this->expenses[] = $aExpense;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeExpense($aExpense)
  {
    $wasRemoved = false;
    //Unable to remove aExpense, as it must always have a lab
    if ($this !== $aExpense->getLab())
    {
      unset($this->expenses[$this->indexOfExpense($aExpense)]);
      $this->expenses = array_values($this->expenses);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  public function addExpenseAt($aExpense, $index)
  {  
    $wasAdded = false;
    if($this->addExpense($aExpense))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfExpenses()) { $index = $this->numberOfExpenses() - 1; }
      array_splice($this->expenses, $this->indexOfExpense($aExpense), 1);
      array_splice($this->expenses, $index, 0, array($aExpense));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveExpenseAt($aExpense, $index)
  {
    $wasAdded = false;
    if($this->indexOfExpense($aExpense) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfExpenses()) { $index = $this->numberOfExpenses() - 1; }
      array_splice($this->expenses, $this->indexOfExpense($aExpense), 1);
      array_splice($this->expenses, $index, 0, array($aExpense));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addExpenseAt($aExpense, $index);
    }
    return $wasAdded;
  }

  public function setURLMS($aURLMS)
  {
    $wasSet = false;
    if ($aURLMS == null)
    {
      return $wasSet;
    }
    
    $existingURLMS = $this->uRLMS;
    $this->uRLMS = $aURLMS;
    if ($existingURLMS != null && $existingURLMS != $aURLMS)
    {
      $existingURLMS->removeLab($this);
    }
    $this->uRLMS->addLab($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    while (count($this->staffs) > 0)
    {
      $aStaff = $this->staffs[count($this->staffs) - 1];
      $aStaff->delete();
      unset($this->staffs[$this->indexOfStaff($aStaff)]);
      $this->staffs = array_values($this->staffs);
    }
    
    while (count($this->equipments) > 0)
    {
      $aEquipment = $this->equipments[count($this->equipments) - 1];
      $aEquipment->delete();
      unset($this->equipments[$this->indexOfEquipment($aEquipment)]);
      $this->equipments = array_values($this->equipments);
    }
    
    while (count($this->supplies) > 0)
    {
      $aSupply = $this->supplies[count($this->supplies) - 1];
      $aSupply->delete();
      unset($this->supplies[$this->indexOfSupply($aSupply)]);
      $this->supplies = array_values($this->supplies);
    }
    
    while (count($this->expenses) > 0)
    {
      $aExpense = $this->expenses[count($this->expenses) - 1];
      $aExpense->delete();
      unset($this->expenses[$this->indexOfExpense($aExpense)]);
      $this->expenses = array_values($this->expenses);
    }
    
    $placeholderURLMS = $this->uRLMS;
    $this->uRLMS = null;
    $placeholderURLMS->removeLab($this);
  }

}
?>