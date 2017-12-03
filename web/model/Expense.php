<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.26.0-b05b57321 modeling language!*/

class Expense
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Expense Attributes
  private $reason;
  private $amountPaid;

  //Expense Associations
  private $lab;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aReason, $aAmountPaid, $aLab)
  {
    $this->reason = $aReason;
    $this->amountPaid = $aAmountPaid;
    $didAddLab = $this->setLab($aLab);
    if (!$didAddLab)
    {
      throw new Exception("Unable to create expense due to lab");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setReason($aReason)
  {
    $wasSet = false;
    $this->reason = $aReason;
    $wasSet = true;
    return $wasSet;
  }

  public function setAmountPaid($aAmountPaid)
  {
    $wasSet = false;
    $this->amountPaid = $aAmountPaid;
    $wasSet = true;
    return $wasSet;
  }

  public function getReason()
  {
    return $this->reason;
  }

  public function getAmountPaid()
  {
    return $this->amountPaid;
  }

  public function getLab()
  {
    return $this->lab;
  }

  public function setLab($aLab)
  {
    $wasSet = false;
    if ($aLab == null)
    {
      return $wasSet;
    }
    
    $existingLab = $this->lab;
    $this->lab = $aLab;
    if ($existingLab != null && $existingLab != $aLab)
    {
      $existingLab->removeExpense($this);
    }
    $this->lab->addExpense($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $placeholderLab = $this->lab;
    $this->lab = null;
    $placeholderLab->removeExpense($this);
  }

}
?>