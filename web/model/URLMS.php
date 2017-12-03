<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.26.0-b05b57321 modeling language!*/

class URLMS
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static $theInstance = null;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //URLMS Associations
  private $lab;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  private function __construct()
  {
    $this->lab = array();
  }

  public static function getInstance()
  {
    if(self::$theInstance == null)
    {
      self::$theInstance = new URLMS();
    }
    return self::$theInstance;
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getLab_index($index)
  {
    $aLab = $this->lab[$index];
    return $aLab;
  }

  public function getLab()
  {
    $newLab = $this->lab;
    return $newLab;
  }

  public function numberOfLab()
  {
    $number = count($this->lab);
    return $number;
  }

  public function hasLab()
  {
    $has = $this->numberOfLab() > 0;
    return $has;
  }

  public function indexOfLab($aLab)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->lab as $lab)
    {
      if ($lab->equals($aLab))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public static function minimumNumberOfLab()
  {
    return 0;
  }

  public function addLabVia($aUsername, $aPassword, $aAccountBalance)
  {
    return new Lab($aUsername, $aPassword, $aAccountBalance, $this);
  }

  public function addLab($aLab)
  {
    $wasAdded = false;
    if ($this->indexOfLab($aLab) !== -1) { return false; }
    $existingURLMS = $aLab->getURLMS();
    $isNewURLMS = $existingURLMS != null && $this !== $existingURLMS;
    if ($isNewURLMS)
    {
      $aLab->setURLMS($this);
    }
    else
    {
      $this->lab[] = $aLab;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeLab($aLab)
  {
    $wasRemoved = false;
    //Unable to remove aLab, as it must always have a uRLMS
    if ($this !== $aLab->getURLMS())
    {
      unset($this->lab[$this->indexOfLab($aLab)]);
      $this->lab = array_values($this->lab);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  
  public function addLabAt($aLab, $index)
  {  
    $wasAdded = false;
    if($this->addLab($aLab))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfLab()) { $index = $this->numberOfLab() - 1; }
      array_splice($this->lab, $this->indexOfLab($aLab), 1);
      array_splice($this->lab, $index, 0, array($aLab));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveLabAt($aLab, $index)
  {
    $wasAdded = false;
    if($this->indexOfLab($aLab) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfLab()) { $index = $this->numberOfLab() - 1; }
      array_splice($this->lab, $this->indexOfLab($aLab), 1);
      array_splice($this->lab, $index, 0, array($aLab));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addLabAt($aLab, $index);
    }
    return $wasAdded;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    while (count($this->lab) > 0)
    {
      $aLab = $this->lab[count($this->lab) - 1];
      $aLab->delete();
      unset($this->lab[$this->indexOfLab($aLab)]);
      $this->lab = array_values($this->lab);
    }
    
  }

}
?>